<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use App\Models\PlantingSchedule;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        if ($user->isPetani()) {
            $userSchedules = PlantingSchedule::where('user_id', $user->id)
                ->orderBy('planting_date', 'desc')
                ->get();

            $userHarvests = Harvest::where('farmer_id', $user->id)
                ->latest('harvest_date')
                ->take(5)
                ->get();

            $totalPanenKg = (int) Harvest::where('farmer_id', $user->id)->sum('harvest_weight_kg');
            $activeSchedules = $userSchedules->where('phase', '!=', 'selesai');
            $totalLuasLahan = (float) $userSchedules->sum('land_area_ha');
            $targetTonaseKg = (int) $userSchedules->sum('target_yield_kg');

            $notifications = [];
            foreach ($activeSchedules as $sch) {
                $days = $sch->daysToHarvest();
                if ($days >= 0 && $days <= 14) {
                    $notifications[] = [
                        'type' => 'warning',
                        'title' => 'Menjelang Panen '.$sch->variety,
                        'message' => 'Estimasi panen dalam '.$days.' hari ('.Carbon::parse($sch->estimated_harvest_date)->isoFormat('D MMMM Y').'). Siapkan tempat jemur atau curing.',
                        'date' => $sch->estimated_harvest_date,
                    ];
                }
                if ($sch->phase === 'pemeliharaan') {
                    $notifications[] = [
                        'type' => 'info',
                        'title' => 'Perawatan & Bumbun '.$sch->variety,
                        'message' => 'Jadwal di '.$sch->location.' memasuki fase pemeliharaan. Lakukan pemupukan susulan dan wiwil tunas ketiak.',
                        'date' => $sch->planting_date,
                    ];
                }
                if ($sch->phase === 'persemaian') {
                    $notifications[] = [
                        'type' => 'info',
                        'title' => 'Persemaian Bibit '.$sch->variety,
                        'message' => 'Kontrol naungan persemaian dan kelembapan bedengan bibit secara rutin pagi & sore.',
                        'date' => $sch->planting_date,
                    ];
                }
            }

            return view('petani.index', compact(
                'user',
                'userSchedules',
                'userHarvests',
                'totalPanenKg',
                'activeSchedules',
                'totalLuasLahan',
                'targetTonaseKg',
                'notifications'
            ));
        }

        $totalStokKg = (int) Product::sum('stock_kg');

        $dbSales = (int) Transaction::where('payment_status', 'lunas')->sum('total_price');
        $totalPenjualan = $dbSales > 0 ? $dbSales : 148500000;

        $prediksiPenjualan = (int) round($totalPenjualan * 1.178);

        $topTembakau = [
            [
                'name' => 'Tembakau Opot (Besuki Na-Oogst)',
                'grade' => 'Super & CW',
                'terjual_kg' => 620,
                'persentase' => 34,
                'pendapatan' => 65200000,
                'trend' => '+22%',
                'status' => 'Paling Diminati Ekspor',
            ],
            [
                'name' => 'Tembakau Samporis',
                'grade' => 'Super Gudang & CW',
                'terjual_kg' => 480,
                'persentase' => 26,
                'pendapatan' => 41800000,
                'trend' => '+15%',
                'status' => 'Favorit Pabrikan Kretek',
            ],
            [
                'name' => 'Tembakau Marakot',
                'grade' => 'Gudangan & CW',
                'terjual_kg' => 390,
                'persentase' => 21,
                'pendapatan' => 28500000,
                'trend' => '+11%',
                'status' => 'Aroma Manis Alami',
            ],
            [
                'name' => 'Tembakau Baleno',
                'grade' => 'CW (AB-1, B-1)',
                'terjual_kg' => 350,
                'persentase' => 19,
                'pendapatan' => 21000000,
                'trend' => '+8%',
                'status' => 'Stok Cepat Terserap',
            ],
        ];

        $petanis = User::where('role', 'petani')->orderBy('created_at', 'desc')->get();
        $recentTransactions = Transaction::with('items')->latest()->take(5)->get();
        $recentHarvests = Harvest::latest('harvest_date')->take(4)->get();

        $stats = [
            'total_stok_kg' => $totalStokKg,
            'total_penjualan' => $totalPenjualan,
            'prediksi_penjualan' => $prediksiPenjualan,
            'prediksi_persen' => 17.8,
            'total_petani' => $petanis->count(),
            'varietas_aktif' => Product::distinct('variety')->count('variety') ?: 4,
            'total_transaksi' => Transaction::count(),
        ];

        return view('admin.index', compact('user', 'petanis', 'stats', 'topTembakau', 'recentTransactions', 'recentHarvests'));
    }

    public function stokIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        $products = Product::orderBy('created_at', 'desc')->get();
        $totalStokKg = (int) $products->sum('stock_kg');

        return view('admin.stok', compact('user', 'products', 'totalStokKg'));
    }

    public function storeStok(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'variety' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:100'],
            'stock_kg' => ['required', 'integer', 'min:0'],
            'moisture_content' => ['nullable', 'string', 'max:50'],
            'origin' => ['nullable', 'string', 'max:255'],
            'price_per_kg' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama batch tembakau wajib diisi.',
            'name.min' => 'Nama batch tembakau minimal 3 karakter.',
            'name.max' => 'Nama batch tembakau maksimal 255 karakter.',
            'variety.required' => 'Varietas tembakau wajib dipilih.',
            'grade.required' => 'Grade mutu tembakau wajib ditentukan.',
            'stock_kg.required' => 'Kuantitas stok riil wajib diisi.',
            'stock_kg.integer' => 'Kuantitas stok harus berupa bilangan bulat.',
            'stock_kg.min' => 'Kuantitas stok minimal 0 Kg.',
            'price_per_kg.required' => 'Harga jual per Kg wajib diisi.',
            'price_per_kg.integer' => 'Harga jual harus berupa bilangan bulat.',
            'price_per_kg.min' => 'Harga jual minimal Rp 0.',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'variety' => $validated['variety'],
            'grade' => $validated['grade'],
            'stock_kg' => $validated['stock_kg'],
            'moisture_content' => $validated['moisture_content'] ?? '12–14%',
            'origin' => $validated['origin'] ?? 'Situbondo, Jawa Timur',
            'price_per_kg' => $validated['price_per_kg'],
            'description' => $validated['description'] ?? null,
            'category' => 'rajang',
            'is_active' => true,
            'is_featured' => true,
        ]);

        return back()->with('status', 'Data stok tembakau berhasil dicatat dan disimpan ke gudang sentra.');
    }

    public function updateStok(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'variety' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:100'],
            'stock_kg' => ['required', 'integer', 'min:0'],
            'moisture_content' => ['nullable', 'string', 'max:50'],
            'origin' => ['nullable', 'string', 'max:255'],
            'price_per_kg' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama batch tembakau wajib diisi.',
            'name.min' => 'Nama batch tembakau minimal 3 karakter.',
            'name.max' => 'Nama batch tembakau maksimal 255 karakter.',
            'variety.required' => 'Varietas tembakau wajib diisi.',
            'grade.required' => 'Grade mutu tembakau wajib ditentukan.',
            'stock_kg.required' => 'Kuantitas stok riil wajib diisi.',
            'stock_kg.integer' => 'Kuantitas stok harus berupa bilangan bulat.',
            'stock_kg.min' => 'Kuantitas stok minimal 0 Kg.',
            'price_per_kg.required' => 'Harga jual per Kg wajib diisi.',
            'price_per_kg.integer' => 'Harga jual harus berupa bilangan bulat.',
            'price_per_kg.min' => 'Harga jual minimal Rp 0.',
        ]);

        $product->update($validated);

        return back()->with('status', 'Data stok tembakau berhasil diperbarui.');
    }

    public function deleteStok(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('status', 'Data tembakau berhasil dihapus dari catatan stok.');
    }

    public function katalogIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        $products = Product::orderBy('created_at', 'desc')->get();

        return view('admin.katalog', compact('user', 'products'));
    }

    public function storeKatalog(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'variety' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:100'],
            'price_per_kg' => ['required', 'integer', 'min:0'],
            'stock_kg' => ['required', 'integer', 'min:0'],
            'origin' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'moisture_content' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama produk etalase wajib diisi.',
            'name.min' => 'Nama produk etalase minimal 3 karakter.',
            'name.max' => 'Nama produk etalase maksimal 255 karakter.',
            'variety.required' => 'Varietas tembakau wajib diisi.',
            'grade.required' => 'Grade mutu produk wajib ditentukan.',
            'price_per_kg.required' => 'Harga jual per Kg wajib diisi.',
            'price_per_kg.integer' => 'Harga jual harus berupa bilangan bulat.',
            'price_per_kg.min' => 'Harga jual minimal Rp 0.',
            'stock_kg.required' => 'Kuantitas stok katalog wajib diisi.',
            'stock_kg.integer' => 'Kuantitas stok harus berupa bilangan bulat.',
            'stock_kg.min' => 'Kuantitas stok minimal 0 Kg.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus berupa jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran file gambar maksimal 4 MB.',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'variety' => $validated['variety'],
            'grade' => $validated['grade'],
            'stock_kg' => $validated['stock_kg'],
            'moisture_content' => $validated['moisture_content'] ?? '12–14%',
            'origin' => $validated['origin'] ?? 'Situbondo, Jawa Timur',
            'price_per_kg' => $validated['price_per_kg'],
            'description' => $validated['description'] ?? null,
            'category' => 'rajang',
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active'),
            'is_featured' => true,
        ]);

        return back()->with('status', 'Produk tembakau baru berhasil ditambahkan ke katalog etalase.');
    }

    public function updateKatalog(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'variety' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:100'],
            'price_per_kg' => ['required', 'integer', 'min:0'],
            'stock_kg' => ['required', 'integer', 'min:0'],
            'origin' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'moisture_content' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama produk etalase wajib diisi.',
            'name.min' => 'Nama produk etalase minimal 3 karakter.',
            'name.max' => 'Nama produk etalase maksimal 255 karakter.',
            'variety.required' => 'Varietas tembakau wajib diisi.',
            'grade.required' => 'Grade mutu produk wajib ditentukan.',
            'price_per_kg.required' => 'Harga jual per Kg wajib diisi.',
            'price_per_kg.integer' => 'Harga jual harus berupa bilangan bulat.',
            'price_per_kg.min' => 'Harga jual minimal Rp 0.',
            'stock_kg.required' => 'Kuantitas stok katalog wajib diisi.',
            'stock_kg.integer' => 'Kuantitas stok harus berupa bilangan bulat.',
            'stock_kg.min' => 'Kuantitas stok minimal 0 Kg.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar harus berupa jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran file gambar maksimal 4 MB.',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $product->update($validated);

        return back()->with('status', 'Data katalog barang berhasil diperbarui.');
    }

    public function transaksiIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        $transactions = Transaction::with(['items', 'user'])->latest()->get();

        $totalTonaseKg = (int) $transactions->sum('total_weight_kg');
        $pickUpCount = $transactions->where('fleet_type', 'pick_up')->count();
        $tambahanArmadaCount = $transactions->where('fleet_type', 'tambahan_armada')->count();

        return view('admin.transaksi', compact('user', 'transactions', 'totalTonaseKg', 'pickUpCount', 'tambahanArmadaCount'));
    }

    public function updateTransaksi(Request $request, Transaction $transaction): RedirectResponse
    {
        $validated = $request->validate([
            'shipping_status' => ['required', 'string', 'in:menunggu_konfirmasi,diproses,dalam_pengiriman,terkirim,dibatalkan'],
            'payment_status' => ['required', 'string', 'in:menunggu_pembayaran,lunas,dibatalkan'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'tracking_notes' => ['nullable', 'string'],
            'estimated_delivery' => ['nullable', 'string', 'max:100'],
        ], [
            'shipping_status.required' => 'Status pengiriman wajib dipilih.',
            'shipping_status.in' => 'Pilihan status pengiriman tidak valid.',
            'payment_status.required' => 'Status pembayaran wajib dipilih.',
            'payment_status.in' => 'Pilihan status pembayaran tidak valid.',
            'tracking_number.max' => 'Nomor resi maksimal 100 karakter.',
            'estimated_delivery.max' => 'Estimasi tiba maksimal 100 karakter.',
        ]);

        $transaction->update($validated);

        return back()->with('status', 'Data status transaksi dan pelacakan armada berhasil diperbarui.');
    }

    public function panenIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        if ($user->isPetani()) {
            $harvests = Harvest::where('farmer_id', $user->id)->latest('harvest_date')->get();
        } else {
            $harvests = Harvest::with('farmer')->latest('harvest_date')->get();
        }

        $totalPanenKg = (int) $harvests->sum('harvest_weight_kg');

        return view('petani.panen', compact('user', 'harvests', 'totalPanenKg'));
    }

    public function storePanen(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'variety' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:100'],
            'harvest_weight_kg' => ['required', 'integer', 'min:1'],
            'moisture_content' => ['nullable', 'string', 'max:50'],
            'harvest_date' => ['required', 'date'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'quality_notes' => ['nullable', 'string', 'max:500'],
            'farmer_id' => ['nullable', 'exists:users,id'],
        ], [
            'variety.required' => 'Varietas tembakau wajib diisi.',
            'variety.max' => 'Nama varietas maksimal 255 karakter.',
            'grade.required' => 'Grade mutu tembakau wajib ditentukan.',
            'harvest_weight_kg.required' => 'Berat hasil panen wajib diisi.',
            'harvest_weight_kg.integer' => 'Berat panen harus berupa bilangan bulat.',
            'harvest_weight_kg.min' => 'Berat panen minimal 1 Kg.',
            'harvest_date.required' => 'Tanggal panen wajib ditentukan.',
            'harvest_date.date' => 'Format tanggal panen tidak valid.',
            'farm_location.max' => 'Lokasi ladang maksimal 255 karakter.',
            'quality_notes.max' => 'Catatan mutu maksimal 500 karakter.',
        ]);

        $farmerId = $user->isPetani() ? $user->id : ($validated['farmer_id'] ?? $user->id);
        $farmer = User::find($farmerId) ?? $user;

        Harvest::create([
            'farmer_id' => $farmer->id,
            'farmer_name' => $farmer->name,
            'variety' => $validated['variety'],
            'grade' => $validated['grade'],
            'harvest_weight_kg' => $validated['harvest_weight_kg'],
            'moisture_content' => $validated['moisture_content'] ?? '12–14%',
            'harvest_date' => $validated['harvest_date'],
            'farm_location' => $validated['farm_location'] ?? ($farmer->farm_location ?? 'Wilayah Situbondo'),
            'quality_notes' => $validated['quality_notes'] ?? null,
            'status' => 'diterima_gudang',
        ]);

        return back()->with('status', 'Data hasil panen berhasil dicatat dan masuk ke sistem penerimaan gudang.');
    }

    public function rekomendasiTanamIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        return view('petani.rekomendasi_tanam', compact('user'));
    }

    public function jadwalIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        if ($user->isPetani()) {
            $schedules = PlantingSchedule::where('user_id', $user->id)
                ->orderBy('planting_date', 'desc')
                ->get();
        } else {
            $schedules = PlantingSchedule::with('user')
                ->orderBy('planting_date', 'desc')
                ->get();
        }

        $totalJadwalAktif = $schedules->where('phase', '!=', 'selesai')->count();
        $totalLuasHa = (float) $schedules->sum('land_area_ha');
        $totalTargetKg = (int) $schedules->sum('target_yield_kg');
        $jadwalPanenDekat = $schedules->filter(function ($item) {
            return $item->isHarvestSoon();
        })->count();

        return view('petani.jadwal_tanam', compact(
            'user',
            'schedules',
            'totalJadwalAktif',
            'totalLuasHa',
            'totalTargetKg',
            'jadwalPanenDekat'
        ));
    }

    public function storeJadwal(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'variety' => ['required', 'string', 'max:255'],
            'land_area_ha' => ['required', 'numeric', 'min:0.01', 'max:999'],
            'location' => ['required', 'string', 'max:255'],
            'planting_date' => ['required', 'date'],
            'estimated_harvest_date' => ['required', 'date', 'after_or_equal:planting_date'],
            'target_yield_kg' => ['required', 'integer', 'min:1'],
            'phase' => ['required', 'string', 'in:persemaian,penanaman,pemeliharaan,siap_panen,selesai'],
            'notes' => ['nullable', 'string', 'max:500'],
            'user_id' => ['nullable', 'exists:users,id'],
        ], [
            'variety.required' => 'Varietas tembakau wajib diisi.',
            'variety.max' => 'Nama varietas maksimal 255 karakter.',
            'land_area_ha.required' => 'Luas lahan tanam wajib diisi.',
            'land_area_ha.numeric' => 'Luas lahan harus berupa angka.',
            'land_area_ha.min' => 'Luas lahan minimal 0.01 Hektar.',
            'location.required' => 'Lokasi lahan / kebun wajib diisi.',
            'location.max' => 'Lokasi kebun maksimal 255 karakter.',
            'planting_date.required' => 'Tanggal mulai tanam/semai wajib ditentukan.',
            'planting_date.date' => 'Format tanggal tanam tidak valid.',
            'estimated_harvest_date.required' => 'Estimasi tanggal panen wajib ditentukan.',
            'estimated_harvest_date.date' => 'Format estimasi tanggal panen tidak valid.',
            'estimated_harvest_date.after_or_equal' => 'Estimasi tanggal panen tidak boleh sebelum tanggal tanam.',
            'target_yield_kg.required' => 'Target hasil panen wajib diisi.',
            'target_yield_kg.integer' => 'Target panen harus berupa bilangan bulat.',
            'target_yield_kg.min' => 'Target panen minimal 1 Kg.',
            'phase.required' => 'Fase tanam wajib ditentukan.',
            'phase.in' => 'Pilihan fase tanam tidak valid.',
            'notes.max' => 'Catatan perawatan maksimal 500 karakter.',
        ]);

        $targetUserId = $user->isPetani() ? $user->id : ($validated['user_id'] ?? $user->id);
        $targetUser = User::find($targetUserId) ?? $user;

        PlantingSchedule::create([
            'user_id' => $targetUser->id,
            'farmer_name' => $targetUser->name,
            'variety' => $validated['variety'],
            'land_area_ha' => $validated['land_area_ha'],
            'location' => $validated['location'],
            'planting_date' => $validated['planting_date'],
            'estimated_harvest_date' => $validated['estimated_harvest_date'],
            'target_yield_kg' => $validated['target_yield_kg'],
            'phase' => $validated['phase'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return back()->with('status', 'Jadwal penanaman tembakau baru berhasil dibuat dan dicatat.');
    }

    public function updateJadwal(Request $request, PlantingSchedule $jadwal): RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        if ($user->isPetani() && $jadwal->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki hak mengubah jadwal petani lain.');
        }

        $validated = $request->validate([
            'variety' => ['required', 'string', 'max:255'],
            'land_area_ha' => ['required', 'numeric', 'min:0.01', 'max:999'],
            'location' => ['required', 'string', 'max:255'],
            'planting_date' => ['required', 'date'],
            'estimated_harvest_date' => ['required', 'date', 'after_or_equal:planting_date'],
            'target_yield_kg' => ['required', 'integer', 'min:1'],
            'phase' => ['required', 'string', 'in:persemaian,penanaman,pemeliharaan,siap_panen,selesai'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'variety.required' => 'Varietas tembakau wajib diisi.',
            'variety.max' => 'Nama varietas maksimal 255 karakter.',
            'land_area_ha.required' => 'Luas lahan tanam wajib diisi.',
            'land_area_ha.numeric' => 'Luas lahan harus berupa angka.',
            'land_area_ha.min' => 'Luas lahan minimal 0.01 Hektar.',
            'location.required' => 'Lokasi lahan / kebun wajib diisi.',
            'location.max' => 'Lokasi kebun maksimal 255 karakter.',
            'planting_date.required' => 'Tanggal mulai tanam/semai wajib ditentukan.',
            'planting_date.date' => 'Format tanggal tanam tidak valid.',
            'estimated_harvest_date.required' => 'Estimasi tanggal panen wajib ditentukan.',
            'estimated_harvest_date.date' => 'Format estimasi tanggal panen tidak valid.',
            'estimated_harvest_date.after_or_equal' => 'Estimasi tanggal panen tidak boleh sebelum tanggal tanam.',
            'target_yield_kg.required' => 'Target hasil panen wajib diisi.',
            'target_yield_kg.integer' => 'Target panen harus berupa bilangan bulat.',
            'target_yield_kg.min' => 'Target panen minimal 1 Kg.',
            'phase.required' => 'Fase tanam wajib ditentukan.',
            'phase.in' => 'Pilihan fase tanam tidak valid.',
            'notes.max' => 'Catatan perawatan maksimal 500 karakter.',
        ]);

        $jadwal->update($validated);

        return back()->with('status', 'Data jadwal penanaman tembakau berhasil diperbarui.');
    }

    public function deleteJadwal(PlantingSchedule $jadwal): RedirectResponse
    {
        $user = Auth::user();
        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        if ($user->isPetani() && $jadwal->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        $jadwal->delete();

        return back()->with('status', 'Jadwal penanaman tembakau berhasil dihapus.');
    }

    public function petaniIndex(): View|RedirectResponse
    {
        $user = Auth::user();
        if (! $user->isAdmin()) {
            return back()->with('error', 'Hanya administrator yang memiliki akses.');
        }

        $petanis = User::where('role', 'petani')->orderBy('created_at', 'desc')->get();

        return view('admin.petani', compact('user', 'petanis'));
    }

    public function storePetani(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if (! $user->isAdmin()) {
            return back()->with('error', 'Hanya administrator yang berhak mendaftarkan akun petani.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:30'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama lengkap petani wajib diisi.',
            'name.min' => 'Nama lengkap petani minimal 3 karakter.',
            'name.max' => 'Nama lengkap petani maksimal 255 karakter.',
            'email.required' => 'Alamat email login wajib diisi.',
            'email.email' => 'Format email login tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'password.required' => 'Kata sandi akun wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'phone.max' => 'Nomor WhatsApp maksimal 30 karakter.',
            'farm_location.max' => 'Nama ladang / kebun maksimal 255 karakter.',
            'address.max' => 'Alamat tinggal maksimal 255 karakter.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petani',
            'phone' => $validated['phone'] ?? null,
            'farm_location' => $validated['farm_location'] ?? 'Wilayah Situbondo',
            'address' => $validated['address'] ?? null,
            'status' => 'active',
        ]);

        return back()->with('status', 'Akun login Petani baru berhasil didaftarkan ke sistem.');
    }

    public function updatePetani(Request $request, User $petani): RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya administrator yang memiliki hak mengubah data petani.');
        }

        if ($petani->role !== 'petani') {
            return back()->with('error', 'Pengguna yang dipilih bukan akun petani.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$petani->id],
            'password' => ['nullable', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:30'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama lengkap petani wajib diisi.',
            'name.min' => 'Nama lengkap petani minimal 3 karakter.',
            'name.max' => 'Nama lengkap petani maksimal 255 karakter.',
            'email.required' => 'Alamat email login wajib diisi.',
            'email.email' => 'Format email login tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'password.min' => 'Kata sandi minimal 6 karakter jika ingin diperbarui.',
            'phone.max' => 'Nomor WhatsApp maksimal 30 karakter.',
            'farm_location.max' => 'Nama ladang / kebun maksimal 255 karakter.',
            'address.max' => 'Alamat tinggal maksimal 255 karakter.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? $petani->phone,
            'farm_location' => $validated['farm_location'] ?? $petani->farm_location,
            'address' => $validated['address'] ?? $petani->address,
        ];

        if (! empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $petani->update($updateData);

        return back()->with('status', 'Data akun Petani berhasil diperbarui.');
    }

    public function deletePetani(User $petani): RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return back()->with('error', 'Akses ditolak.');
        }

        if ($petani->role === 'petani') {
            $petani->delete();

            return back()->with('status', 'Data petani berhasil dihapus dari sistem.');
        }

        return back()->with('error', 'Akun tersebut bukan petani.');
    }
}

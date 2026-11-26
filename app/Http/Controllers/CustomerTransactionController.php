<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CustomerTransactionController extends Controller
{
    public function dashboard(): View
    {
        $user = Auth::user();

        $transactions = Transaction::with('items')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalBelanja = (int) $transactions->where('payment_status', 'lunas')->sum('total_price');
        $totalTonaseKg = (int) $transactions->sum('total_weight_kg');
        $activeOrders = $transactions->whereIn('shipping_status', ['menunggu_konfirmasi', 'diproses', 'dalam_pengiriman'])->count();

        return view('customer.dashboard', compact('user', 'transactions', 'totalBelanja', 'totalTonaseKg', 'activeOrders'));
    }

    public function index(): View
    {
        $user = Auth::user();

        $transactions = Transaction::with('items')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('customer.transaksi', compact('user', 'transactions'));
    }

    public function show(Transaction $transaction): View|RedirectResponse
    {
        $user = Auth::user();

        if ($transaction->user_id !== $user->id && ! $user->isAdmin()) {
            abort(403, 'Akses data transaksi tidak sah.');
        }

        $transaction->load('items.product');

        return view('customer.detail_transaksi', compact('user', 'transaction'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'min:3', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'kabupaten' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'desa' => ['required', 'string', 'max:100'],
            'customer_address' => ['required', 'string', 'max:500'],
            'fleet_type' => ['nullable', 'string', 'in:pick_up,tambahan_armada'],
            'product_id' => ['nullable', 'exists:products,id'],
            'quantity_kg' => ['nullable', 'integer', 'min:1'],
        ], [
            'customer_name.required' => 'Nama lengkap penerima wajib diisi.',
            'customer_name.min' => 'Nama penerima minimal 3 karakter.',
            'customer_name.max' => 'Nama penerima maksimal 255 karakter.',
            'customer_phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'customer_phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'kabupaten.required' => 'Kabupaten / Kota tujuan wajib diisi.',
            'kecamatan.required' => 'Kecamatan tujuan wajib diisi.',
            'desa.required' => 'Desa / Kelurahan tujuan wajib diisi.',
            'customer_address.required' => 'Alamat lengkap pengiriman wajib diisi.',
            'customer_address.max' => 'Alamat lengkap maksimal 500 karakter.',
            'fleet_type.in' => 'Pilihan armada pengantaran tidak valid.',
            'product_id.exists' => 'Produk tembakau yang dipilih tidak ditemukan.',
            'quantity_kg.integer' => 'Jumlah tonase pesanan harus berupa bilangan bulat.',
            'quantity_kg.min' => 'Jumlah tonase pesanan minimal 1 Kg.',
        ]);

        $user->update([
            'phone' => $validated['customer_phone'],
            'kabupaten' => $validated['kabupaten'],
            'kecamatan' => $validated['kecamatan'],
            'desa' => $validated['desa'],
            'address' => $validated['customer_address'],
        ]);

        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty() && ! empty($validated['product_id'])) {
            $product = Product::findOrFail($validated['product_id']);
            $qty = (int) ($validated['quantity_kg'] ?? 1);

            $totalWeightKg = $qty;
            $itemsSubtotal = $qty * $product->price_per_kg;

            $recommendedFleet = Transaction::determineFleet($totalWeightKg);
            $fleetType = $validated['fleet_type'] ?? $recommendedFleet['type'];
            $fleetName = $fleetType === 'pick_up' ? 'Armada Standar Pick Up (< 300 Kg)' : 'Tambahan Armada Truk Kargo (>= 300 Kg)';

            $shippingCost = Transaction::calculateShippingCost($fleetType, $itemsSubtotal);
            $totalPrice = $itemsSubtotal + $shippingCost;

            $invoiceCode = 'INV-'.date('Ymd').'-'.strtoupper(Str::random(4));

            $transaction = Transaction::create([
                'invoice_code' => $invoiceCode,
                'user_id' => $user->id,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'kabupaten' => $validated['kabupaten'],
                'kecamatan' => $validated['kecamatan'],
                'desa' => $validated['desa'],
                'customer_address' => $validated['customer_address'],
                'total_weight_kg' => $totalWeightKg,
                'items_subtotal' => $itemsSubtotal,
                'shipping_cost' => $shippingCost,
                'total_price' => $totalPrice,
                'fleet_type' => $fleetType,
                'fleet_name' => $fleetName,
                'shipping_status' => 'menunggu_konfirmasi',
                'payment_status' => 'menunggu_pembayaran',
                'tracking_number' => 'SRN-'.strtoupper(Str::random(6)),
                'tracking_notes' => 'Pesanan baru tercatat. Armada: '.$fleetName.($shippingCost > 0 ? ' (Ongkir 10%: Rp '.number_format($shippingCost).')' : ' (Bebas ongkir tambahan)'),
                'estimated_delivery' => date('d M Y', strtotime('+3 days')),
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'variety' => $product->variety,
                'grade' => $product->grade,
                'quantity_kg' => $qty,
                'price_per_kg' => $product->price_per_kg,
                'subtotal' => $itemsSubtotal,
            ]);

            return redirect()->route('customer.transaksi.show', $transaction->id)
                ->with('status', 'Transaksi berhasil dibuat! Alokasi: '.$fleetName.($shippingCost > 0 ? ' dengan ongkir 10% (Rp '.number_format($shippingCost).')' : ''));
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('produk')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $totalWeightKg = (int) $cartItems->sum('quantity_kg');
        $itemsSubtotal = (int) $cartItems->sum(function ($item) {
            return $item->quantity_kg * ($item->product->price_per_kg ?? 0);
        });

        $recommendedFleet = Transaction::determineFleet($totalWeightKg);
        $fleetType = $validated['fleet_type'] ?? $recommendedFleet['type'];
        $fleetName = $fleetType === 'pick_up' ? 'Armada Standar Pick Up (< 300 Kg)' : 'Tambahan Armada Truk Kargo (>= 300 Kg)';

        $shippingCost = Transaction::calculateShippingCost($fleetType, $itemsSubtotal);
        $totalPrice = $itemsSubtotal + $shippingCost;

        $invoiceCode = 'INV-'.date('Ymd').'-'.strtoupper(Str::random(4));

        $transaction = Transaction::create([
            'invoice_code' => $invoiceCode,
            'user_id' => $user->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'kabupaten' => $validated['kabupaten'],
            'kecamatan' => $validated['kecamatan'],
            'desa' => $validated['desa'],
            'customer_address' => $validated['customer_address'],
            'total_weight_kg' => $totalWeightKg,
            'items_subtotal' => $itemsSubtotal,
            'shipping_cost' => $shippingCost,
            'total_price' => $totalPrice,
            'fleet_type' => $fleetType,
            'fleet_name' => $fleetName,
            'shipping_status' => 'menunggu_konfirmasi',
            'payment_status' => 'menunggu_pembayaran',
            'tracking_number' => 'SRN-'.strtoupper(Str::random(6)),
            'tracking_notes' => 'Pesanan baru dibuat. Armada: '.$fleetName.($shippingCost > 0 ? ' (Ongkir 10%: Rp '.number_format($shippingCost).')' : ' (Bebas ongkir tambahan)'),
            'estimated_delivery' => date('d M Y', strtotime('+3 days')),
        ]);

        foreach ($cartItems as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'variety' => $item->product->variety,
                'grade' => $item->product->grade,
                'quantity_kg' => $item->quantity_kg,
                'price_per_kg' => $item->product->price_per_kg,
                'subtotal' => $item->quantity_kg * $item->product->price_per_kg,
            ]);
        }

        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('customer.transaksi.show', $transaction->id)
            ->with('status', 'Transaksi berhasil dibuat! Alokasi: '.$fleetName.($shippingCost > 0 ? ' dengan ongkir 10% (Rp '.number_format($shippingCost).')' : ''));
    }

    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $user = Auth::user();

        if ($transaction->user_id !== $user->id) {
            abort(403);
        }

        if (in_array($transaction->shipping_status, ['dalam_pengiriman', 'terkirim'])) {
            return back()->with('error', 'Pesanan yang sedang dalam pengiriman tidak dapat diubah.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'min:3', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'kabupaten' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'desa' => ['required', 'string', 'max:100'],
            'customer_address' => ['required', 'string', 'max:500'],
            'fleet_type' => ['nullable', 'string', 'in:pick_up,tambahan_armada'],
        ], [
            'customer_name.required' => 'Nama penerima wajib diisi.',
            'customer_name.min' => 'Nama penerima minimal 3 karakter.',
            'customer_name.max' => 'Nama penerima maksimal 255 karakter.',
            'customer_phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'customer_phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'kabupaten.required' => 'Kabupaten / Kota tujuan wajib diisi.',
            'kecamatan.required' => 'Kecamatan tujuan wajib diisi.',
            'desa.required' => 'Desa / Kelurahan tujuan wajib diisi.',
            'customer_address.required' => 'Alamat lengkap pengiriman wajib diisi.',
            'customer_address.max' => 'Alamat lengkap maksimal 500 karakter.',
            'fleet_type.in' => 'Pilihan armada pengantaran tidak valid.',
        ]);

        if (! empty($validated['fleet_type'])) {
            $fleetType = $validated['fleet_type'];
            $fleetName = $fleetType === 'pick_up' ? 'Armada Standar Pick Up (< 300 Kg)' : 'Tambahan Armada Truk Kargo (>= 300 Kg)';
            $itemsSubtotal = $transaction->items_subtotal > 0 ? $transaction->items_subtotal : $transaction->total_price;
            $shippingCost = Transaction::calculateShippingCost($fleetType, $itemsSubtotal);

            $validated['fleet_name'] = $fleetName;
            $validated['items_subtotal'] = $itemsSubtotal;
            $validated['shipping_cost'] = $shippingCost;
            $validated['total_price'] = $itemsSubtotal + $shippingCost;
        }

        $transaction->update($validated);

        return back()->with('status', 'Informasi pengantaran transaksi berhasil diperbarui.');
    }

    public function cancel(Transaction $transaction): RedirectResponse
    {
        $user = Auth::user();

        if ($transaction->user_id !== $user->id) {
            abort(403);
        }

        if ($transaction->shipping_status !== 'menunggu_konfirmasi') {
            return back()->with('error', 'Hanya pesanan berstatus menunggu konfirmasi yang dapat dibatalkan.');
        }

        $transaction->update([
            'shipping_status' => 'dibatalkan',
            'payment_status' => 'dibatalkan',
            'tracking_notes' => 'Pesanan dibatalkan oleh pembeli.',
        ]);

        return back()->with('status', 'Transaksi berhasil dibatalkan.');
    }
}

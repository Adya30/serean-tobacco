@extends('layouts.dashboard')

@section('title', 'Pencatatan Stok Tembakau — Serean Tobacco')
@section('page_title', 'Pencatatan Stok Tembakau')

@section('content')

    @if (Auth::user()->isAdmin())
        <div class="flex justify-end">
            <button onclick="document.getElementById('modalTambahStok').classList.remove('hidden')" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all inline-flex items-center gap-2 shadow-sm shrink-0 cursor-pointer">
                <i class="fa-solid fa-plus text-brand-gold text-xs"></i>
                <span>Catat Stok Baru</span>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Akumulasi Stok Gudang</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ number_format($totalStokKg) }} Kg</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Varietas Terdaftar</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ $products->count() }} Item Batch</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-leaf"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Kadar Air Standar</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">12–14%</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                <i class="fa-solid fa-droplet"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
        <div class="block sm:hidden divide-y divide-brand-border">
            @forelse ($products as $product)
                <div class="p-4 space-y-2.5">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $product->name }}</span>
                            <span class="text-[11px] text-brand-muted block mt-0.5">{{ $product->variety }}</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 border border-brand-gold/30 text-brand-espresso whitespace-nowrap shrink-0">
                            {{ $product->grade ?? 'CW' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs pt-1 border-t border-brand-border/60">
                        <div>
                            <span class="text-[10px] text-brand-muted block">Stok Riil Gudang</span>
                            <span class="font-serif font-bold text-sm {{ $product->stock_kg > 100 ? 'text-emerald-700' : 'text-amber-600' }}">
                                {{ number_format($product->stock_kg) }} Kg
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] text-brand-muted block">Harga Jual / Kg</span>
                            <span class="font-serif font-bold text-sm text-brand-espresso">
                                Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-stone-500 pt-1">
                        <span><i class="fa-solid fa-droplet text-brand-gold mr-1 text-[10px]"></i>{{ $product->moisture_content ?? '12–14%' }}</span>
                        <span class="truncate max-w-[180px]">{{ $product->origin }}</span>
                    </div>

                    @if (Auth::user()->isAdmin())
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-brand-border/60">
                            <button type="button" onclick="openEditStokModal({{ json_encode($product) }})" class="px-3 py-1.5 rounded-full border border-brand-border hover:border-brand-gold hover:bg-amber-50 text-brand-espresso text-xs font-semibold transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-regular fa-pen-to-square text-[10px]"></i>
                                <span>Ubah</span>
                            </button>
                            <form action="{{ route('dashboard.stok.delete', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan stok ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-full border border-red-200 hover:bg-red-50 text-red-600 text-xs font-semibold transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                                    <i class="fa-regular fa-trash-can text-[10px]"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-brand-muted text-xs">
                    Belum ada data stok tembakau tercatat.
                </div>
            @endforelse
        </div>

        <div class="hidden sm:block overflow-x-auto no-scrollbar">
            <table class="w-full text-left text-xs min-w-[700px]">
                <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-5 sm:px-6">Nama Tembakau &amp; Varietas</th>
                        <th class="py-3.5 px-5 sm:px-6 whitespace-nowrap">Grade</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center whitespace-nowrap">Stok Riil (Kg)</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center whitespace-nowrap">Kadar Air</th>
                        <th class="py-3.5 px-5 sm:px-6">Asal / Gudang</th>
                        <th class="py-3.5 px-5 sm:px-6 text-right whitespace-nowrap">Harga Jual / Kg</th>
                        @if (Auth::user()->isAdmin())
                            <th class="py-3.5 px-5 sm:px-6 text-center whitespace-nowrap">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border">
                    @forelse ($products as $product)
                        <tr class="hover:bg-brand-surface/60 transition-colors">
                            <td class="py-4 px-5 sm:px-6">
                                <div>
                                    <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $product->name }}</span>
                                    <span class="text-[11px] text-brand-muted">{{ $product->variety }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-5 sm:px-6 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50/90 border border-brand-gold/35 text-brand-espresso whitespace-nowrap shadow-2xs">
                                    {{ $product->grade ?? 'CW' }}
                                </span>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-center">
                                <span class="font-serif font-bold text-sm {{ $product->stock_kg > 100 ? 'text-emerald-700' : 'text-amber-600' }}">
                                    {{ number_format($product->stock_kg) }} Kg
                                </span>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-center font-mono text-stone-600">
                                {{ $product->moisture_content ?? '12–14%' }}
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-stone-600">
                                {{ $product->origin }}
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-right font-serif font-bold text-brand-espresso">
                                Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}
                            </td>
                            @if (Auth::user()->isAdmin())
                                <td class="py-4 px-5 sm:px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" onclick="openEditStokModal({{ json_encode($product) }})" class="w-8 h-8 rounded-full border border-brand-border hover:border-brand-gold hover:bg-amber-50 text-stone-500 hover:text-brand-espresso transition-colors inline-flex items-center justify-center cursor-pointer" title="Ubah Data Stok">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                        </button>
                                        <form action="{{ route('dashboard.stok.delete', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan stok ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-full border border-brand-border hover:border-red-300 hover:bg-red-50 text-stone-400 hover:text-red-600 transition-colors inline-flex items-center justify-center cursor-pointer" title="Hapus Stok">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 7 : 6 }}" class="py-12 text-center text-brand-muted text-xs">
                                Belum ada data stok tembakau tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('modals')
    @if (Auth::user()->isAdmin())
        <div id="modalTambahStok" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Catat Stok Tembakau Baru</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Input data batch tembakau yang masuk ke gudang sentra.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalTambahStok').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form action="{{ route('dashboard.stok.store') }}" method="POST" class="space-y-4 pt-5 text-xs">
                    @csrf

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nama Tembakau / Batch <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Tembakau Opot Super Gudang 2026" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Varietas Tembakau <span class="text-red-500">*</span></label>
                            <select name="variety" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                                <option value="Tembakau Opot (Besuki Na-Oogst)">Tembakau Opot / (Besuki Na-Oogst)</option>
                                <option value="Tembakau Samporis">Tembakau Samporis</option>
                                <option value="Tembakau Marakot">Tembakau Marakot</option>
                                <option value="Tembakau Baleno">Tembakau Baleno</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Klasifikasi Grade <span class="text-red-500">*</span></label>
                            <select name="grade" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                                <option value="Super">Super (Rp 95k–130k)</option>
                                <option value="Super Gudang">Super Gudang (Rp 85k–95k)</option>
                                <option value="Gudangan">Gudangan (Rp 70k–85k)</option>
                                <option value="CW">CW (Rp 40k–60k)</option>
                                <option value="CW (AB-1)">CW (AB-1) - Rp 60.000</option>
                                <option value="CW (AB-2)">CW (AB-2) - Rp 58.000</option>
                                <option value="CW (AB-3)">CW (AB-3) - Rp 56.000</option>
                                <option value="CW (B-1)">CW (B-1) - Rp 55.000</option>
                                <option value="CW (B-2)">CW (B-2) - Rp 53.000</option>
                                <option value="CW (B-3)">CW (B-3) - Rp 51.000</option>
                                <option value="CW (C-1)">CW (C-1) - Rp 49.000</option>
                                <option value="CW (C-2)">CW (C-2) - Rp 47.000</option>
                                <option value="CW (C-3)">CW (C-3) - Rp 45.000</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kuantitas Stok (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" name="stock_kg" required min="0" placeholder="500" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kadar Air</label>
                            <input type="text" name="moisture_content" value="12–14%" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Harga / Kg (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="price_per_kg" required min="0" placeholder="60000" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Asal Wilayah / Kebun</label>
                        <input type="text" name="origin" placeholder="Sentra Banyuglugur, Situbondo" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Catatan Kualitas &amp; Curing</label>
                        <textarea name="description" rows="2" placeholder="Karakter rajangan halus, warna getah seragam..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalTambahStok').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer transition-colors">
                            Simpan Data Stok
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalEditStok" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Ubah Data Stok Tembakau</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Perbarui tonase atau informasi mutu batch tembakau.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalEditStok').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form id="formEditStok" method="POST" class="space-y-4 pt-5 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nama Tembakau <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_name" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Varietas Tembakau <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_variety" name="variety" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Grade <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_grade" name="grade" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Stok Riil (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" id="edit_stock_kg" name="stock_kg" required min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kadar Air</label>
                            <input type="text" id="edit_moisture" name="moisture_content" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Harga / Kg (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" id="edit_price" name="price_per_kg" required min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Asal Wilayah / Kebun</label>
                        <input type="text" id="edit_origin" name="origin" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Catatan</label>
                        <textarea id="edit_description" name="description" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalEditStok').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer transition-colors">
                            Perbarui Stok
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditStokModal(product) {
                const form = document.getElementById('formEditStok');
                form.action = '/dashboard/stok/' + product.id;
                document.getElementById('edit_name').value = product.name;
                document.getElementById('edit_variety').value = product.variety;
                document.getElementById('edit_grade').value = product.grade || 'CW';
                document.getElementById('edit_stock_kg').value = product.stock_kg;
                document.getElementById('edit_moisture').value = product.moisture_content || '12–14%';
                document.getElementById('edit_price').value = product.price_per_kg;
                document.getElementById('edit_origin').value = product.origin || '';
                document.getElementById('edit_description').value = product.description || '';
                document.getElementById('modalEditStok').classList.remove('hidden');
            }
        </script>
    @endif
@endpush

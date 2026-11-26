@extends('dashboard.layout')

@section('title', 'Katalog Barang — Serean Tobacco')
@section('page_title', 'Katalog Barang Tembakau')

@section('content')

    @if (Auth::user()->isAdmin())
        <div class="flex justify-end">
            <button onclick="document.getElementById('modalTambahKatalog').classList.remove('hidden')" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all inline-flex items-center gap-2 shadow-sm shrink-0 cursor-pointer">
                <i class="fa-solid fa-plus text-brand-gold text-xs"></i>
                <span>Tambah Barang Baru</span>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse ($products as $product)
            <div class="p-5 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-3.5 bg-stone-100">
                        @if ($product->image_url ?? $product->image)
                            <img src="{{ $product->image_url ?? asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-stone-300 text-3xl">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                        @endif
                        <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/95 backdrop-blur-xs text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                            {{ $product->grade ?? 'CW' }}
                        </span>
                        <span class="absolute bottom-2.5 right-2.5 px-2.5 py-0.5 rounded-full {{ $product->is_active ? 'bg-emerald-600 text-white' : 'bg-stone-500 text-white' }} text-[10px] font-bold shadow">
                            {{ $product->is_active ? 'Aktif di Etalase' : 'Nonaktif' }}
                        </span>
                    </div>

                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[11px] font-bold text-brand-gold">{{ $product->variety }}</span>
                        <span class="text-[10px] text-stone-400">• {{ $product->origin }}</span>
                    </div>

                    <h3 class="font-serif font-bold text-base text-brand-espresso mb-1.5">{{ $product->name }}</h3>
                    <p class="text-xs text-brand-muted line-clamp-2 leading-relaxed mb-3">
                        {{ $product->description ?? 'Tembakau rajangan halus bermutu tinggi hasil panen sentra pengolahan Situbondo.' }}
                    </p>
                </div>

                <div class="pt-3 border-t border-brand-border flex items-center justify-between">
                    <div>
                        <span class="text-[10px] text-brand-muted block uppercase">Harga Jual</span>
                        <span class="font-serif font-bold text-base text-brand-espresso">
                            Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}<span class="text-xs font-normal text-brand-muted">/kg</span>
                        </span>
                    </div>

                    @if (Auth::user()->isAdmin())
                        <button type="button" onclick="openEditKatalogModal({{ json_encode($product) }})" class="px-3.5 py-1.5 rounded-full border border-brand-border hover:border-brand-gold bg-brand-surface text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-regular fa-pen-to-square text-[11px] text-brand-gold"></i>
                            <span>Ubah Barang</span>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-3 p-12 bg-white rounded-3xl border border-brand-border text-center text-xs text-brand-muted">
                Belum ada produk di dalam katalog barang.
            </div>
        @endforelse
    </div>

@endsection

@push('modals')
    @if (Auth::user()->isAdmin())
        <div id="modalTambahKatalog" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Tambah Barang ke Katalog</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Barang akan langsung tampil di etalase website publik.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalTambahKatalog').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form action="{{ route('dashboard.katalog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-5 text-xs">
                    @csrf

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nama Barang / Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Tembakau Opot Na-Oogst Super" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Foto / Gambar Produk Tembakau (Maksimal 4 MB)</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full px-3.5 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[11px] file:font-semibold file:bg-brand-espresso file:text-white hover:file:bg-brand-dark cursor-pointer">
                        <span class="block text-[11px] text-brand-muted mt-1">Format: JPG, JPEG, PNG, WEBP (Maksimal 4 MB). Disimpan langsung ke objek storage.</span>
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
                            <label class="block font-semibold text-brand-espresso mb-1">Grade Rajang Halus <span class="text-red-500">*</span></label>
                            <select name="grade" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                                <option value="Super">Super (Rp 95k–130k)</option>
                                <option value="Super Gudang">Super Gudang (Rp 85k–95k)</option>
                                <option value="Gudangan">Gudangan (Rp 70k–85k)</option>
                                <option value="CW">CW (Rp 40k–60k)</option>
                                <option value="CW (AB-1)">CW (AB-1) - Rp 60.000</option>
                                <option value="CW (AB-2)">CW (AB-2) - Rp 58.000</option>
                                <option value="CW (B-1)">CW (B-1) - Rp 55.000</option>
                                <option value="CW (C-1)">CW (C-1) - Rp 49.000</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Harga Jual / Kg (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="price_per_kg" required min="0" placeholder="60000" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Stok Awal Siap Kirim (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" name="stock_kg" required min="0" placeholder="500" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Asal Daerah Sentra</label>
                        <input type="text" name="origin" placeholder="Besuki &amp; Situbondo, Jawa Timur" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Deskripsi Karakter &amp; Rasa</label>
                        <textarea name="description" rows="3" placeholder="Aroma manis alami, hisapan enteng, kadar getah terjaga..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="tambah_is_active" name="is_active" value="1" checked class="rounded border-brand-border text-brand-gold focus:ring-brand-gold">
                        <label for="tambah_is_active" class="font-semibold text-brand-espresso">Langsung publikasikan ke etalase katalog website</label>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalTambahKatalog').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer transition-colors">
                            Simpan ke Katalog
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalEditKatalog" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Ubah Data Katalog Barang</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Perbarui informasi harga, stok, atau status publikasi etalase.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalEditKatalog').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form id="formEditKatalog" method="POST" enctype="multipart/form-data" class="space-y-4 pt-5 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nama Barang / Produk <span class="text-red-500">*</span></label>
                        <input type="text" id="katalog_name" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Foto / Gambar Produk Tembakau (Maksimal 4 MB, Opsional)</label>
                        <div id="katalog_image_preview_container" class="hidden mb-2.5 p-2 rounded-xl bg-brand-surface border border-brand-border flex items-center gap-3">
                            <img id="katalog_current_img" src="" alt="Preview Produk" class="w-14 h-14 rounded-lg object-cover border border-brand-border">
                            <div>
                                <span class="text-[11px] font-semibold text-brand-espresso block">Foto Produk Saat Ini</span>
                                <span class="text-[10px] text-brand-muted">Pilih file baru jika ingin mengganti foto yang tersimpan di objek storage.</span>
                            </div>
                        </div>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full px-3.5 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[11px] file:font-semibold file:bg-brand-espresso file:text-white hover:file:bg-brand-dark cursor-pointer">
                        <span class="block text-[11px] text-brand-muted mt-1">Format: JPG, JPEG, PNG, WEBP (Maksimal 4 MB). Disimpan langsung ke objek storage.</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Varietas <span class="text-red-500">*</span></label>
                            <input type="text" id="katalog_variety" name="variety" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Grade <span class="text-red-500">*</span></label>
                            <input type="text" id="katalog_grade" name="grade" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Harga Jual / Kg (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" id="katalog_price" name="price_per_kg" required min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Stok Ready (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" id="katalog_stock" name="stock_kg" required min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Asal Daerah Sentra</label>
                        <input type="text" id="katalog_origin" name="origin" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Deskripsi Produk</label>
                        <textarea id="katalog_description" name="description" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="katalog_is_active" name="is_active" value="1" class="rounded border-brand-border text-brand-gold focus:ring-brand-gold">
                        <label for="katalog_is_active" class="font-semibold text-brand-espresso">Tampilkan aktif di etalase katalog website</label>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalEditKatalog').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer transition-colors">
                            Perbarui Data Katalog
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditKatalogModal(product) {
                const form = document.getElementById('formEditKatalog');
                form.action = '/dashboard/katalog/' + product.id;
                document.getElementById('katalog_name').value = product.name;
                document.getElementById('katalog_variety').value = product.variety;
                document.getElementById('katalog_grade').value = product.grade || 'CW';
                document.getElementById('katalog_price').value = product.price_per_kg;
                document.getElementById('katalog_stock').value = product.stock_kg;
                document.getElementById('katalog_origin').value = product.origin || '';
                document.getElementById('katalog_description').value = product.description || '';
                document.getElementById('katalog_is_active').checked = Boolean(product.is_active);

                const previewContainer = document.getElementById('katalog_image_preview_container');
                const previewImg = document.getElementById('katalog_current_img');
                const imgSource = product.image_url || product.image;
                if (imgSource) {
                    previewImg.src = imgSource.startsWith('http') || imgSource.startsWith('/') ? imgSource : '/' + imgSource;
                    previewContainer.classList.remove('hidden');
                } else {
                    previewContainer.classList.add('hidden');
                }

                document.getElementById('modalEditKatalog').classList.remove('hidden');
            }
        </script>
    @endif
@endpush

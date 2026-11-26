@extends('layouts.app')

@section('title', 'Katalog Varietas Tembakau & Daftar Grade 2026 — Serean Tobacco')
@section('meta_description', 'Katalog varietas tembakau rajangan halus Nusantara: Tembakau Opot (Besuki Na-Oogst), Samporis, Marakot, dan Baleno dengan daftar harga resmi grade 2026.')

@section('content')

    <section class="pt-28 sm:pt-36 pb-12 sm:pb-16 border-b border-brand-border bg-gradient-to-b from-brand-surface to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-3 shadow-sm">
                <i class="fa-solid fa-box-open text-xs"></i>
                <span>Sentra Pengolahan Tembakau Situbondo</span>
            </span>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#1a0f07] leading-tight max-w-4xl tracking-tight">
                Koleksi Varietas Tembakau Rajangan Halus &amp; Daftar Grade 2026
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-brand-muted mt-3 max-w-3xl leading-relaxed">
                Menyediakan 4 varietas tembakau rajangan unggulan sentra Tapal Kuda: Tembakau Opot (Besuki Na-Oogst), Samporis, Marakot, dan Baleno dengan standar kadar air 12–14%, pengeringan teratur, dan sistem penyesuaian armada otomatis.
            </p>

            <div class="flex flex-wrap items-center gap-2.5 pt-6">
                <a href="#daftar-grade" class="px-4 py-2 rounded-full text-xs font-semibold bg-brand-espresso text-white hover:bg-brand-dark transition-all shadow-sm inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-table-list text-brand-gold text-[11px]"></i>
                    <span>Tabel Rincian Grade 2026</span>
                </a>
                <a href="#koleksi-produk" class="px-4 py-2 rounded-full text-xs font-semibold bg-white text-brand-espresso border border-brand-border hover:border-brand-gold transition-all shadow-sm">
                    Koleksi Varietas Siap Kirim
                </a>
            </div>
        </div>
    </section>

    <section id="daftar-grade" class="py-14 sm:py-20 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="px-3.5 py-1 rounded-full bg-amber-50 text-brand-gold border border-brand-gold/30 text-xs font-bold uppercase tracking-wider inline-block">
                    Standar Mutu &amp; Kualitas
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1a0f07] tracking-tight">
                    Tingkatan Grade Tembakau Rajang Halus
                </h2>
                <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                    Setiap varietas tembakau (Opot, Samporis, Marakot, Baleno) dipilah berdasarkan 4 tingkatan mutu rajangan halus resmi sentra Serean Tobacco.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-amber-100 text-brand-gold flex items-center justify-center font-bold text-sm mb-4">
                            1
                        </div>
                        <span class="text-[11px] font-bold text-brand-gold uppercase tracking-wider block">Grade Standar Pasar</span>
                        <h3 class="font-serif font-extrabold text-2xl text-brand-espresso mt-1">CW</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Campuran daun bagian tengah dan bawah dengan getah gurih stabil, rajangan halus seragam, dan harga paling terjangkau.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border">
                        <span class="text-[10px] text-brand-muted block uppercase">Rentang Harga</span>
                        <span class="font-serif font-extrabold text-lg text-brand-espresso">Rp 40.000 – 60.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-amber-100 text-brand-gold flex items-center justify-center font-bold text-sm mb-4">
                            2
                        </div>
                        <span class="text-[11px] font-bold text-brand-gold uppercase tracking-wider block">Grade Gudang Pilihan</span>
                        <h3 class="font-serif font-extrabold text-2xl text-brand-espresso mt-1">Gudangan</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Hasil sortiran daun pilihan gudang dengan warna cokelat merata, getah melimpah, dan hisapan harum mantap.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border">
                        <span class="text-[10px] text-brand-muted block uppercase">Rentang Harga</span>
                        <span class="font-serif font-extrabold text-lg text-brand-espresso">Rp 70.000 – 85.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-amber-100 text-brand-gold flex items-center justify-center font-bold text-sm mb-4">
                            3
                        </div>
                        <span class="text-[11px] font-bold text-brand-gold uppercase tracking-wider block">Grade Mutu Tinggi</span>
                        <h3 class="font-serif font-extrabold text-2xl text-brand-espresso mt-1">Super Gudang</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Tembakau petikan daun atas dengan kadar air 12–13% terjaga presisi. Rasa gurih legit dan asap tebal tanpa rasa pahit.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border">
                        <span class="text-[10px] text-brand-muted block uppercase">Rentang Harga</span>
                        <span class="font-serif font-extrabold text-lg text-brand-gold">Rp 85.000 – 95.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-amber-400 text-white flex items-center justify-center font-bold text-sm mb-4 shadow">
                            4
                        </div>
                        <span class="text-[11px] font-bold text-amber-600 uppercase tracking-wider block">Kasta Tertinggi</span>
                        <h3 class="font-serif font-extrabold text-2xl text-brand-espresso mt-1">Super</h3>
                        <p class="text-xs text-brand-muted mt-2 leading-relaxed">
                            Kualitas paling prima dengan getah pekat alami, daun utuh tanpa cacat, aroma wangi surgawi, standar lintingan premium &amp; cerutu ekspor.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-brand-border">
                        <span class="text-[10px] text-brand-muted block uppercase">Rentang Harga</span>
                        <span class="font-serif font-extrabold text-lg text-amber-700">Rp 95.000 – 130.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 rounded-3xl bg-brand-surface border border-brand-border space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold text-brand-gold uppercase tracking-wider block">Daftar Harga Resmi 2026</span>
                        <h3 class="font-serif font-extrabold text-xl sm:text-2xl text-[#1a0f07] mt-0.5">
                            Rincian Harga Grade Rajang Halus (Netto Setelah Potongan 5K)
                        </h3>
                        <p class="text-xs text-brand-muted mt-1">
                            Daftar harga grade tembakau rajang halus 2026 per kilogram langsung dari sentra pengolahan.
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold shrink-0">
                        <i class="fa-solid fa-tag text-emerald-600"></i>
                        <span>Potongan Harga Rp 5.000 / Kg Berlaku</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-3 sm:gap-4">
                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade AB-1</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 65.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-emerald-700">Rp 60.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade AB-2</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 63.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-emerald-700">Rp 58.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade AB-3</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 61.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-emerald-700">Rp 56.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade B-1</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 60.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-brand-espresso">Rp 55.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade B-2</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 58.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-brand-espresso">Rp 53.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade B-3</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 56.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-brand-espresso">Rp 51.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade C-1</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 54.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-brand-gold">Rp 49.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade C-2</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 52.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-brand-gold">Rp 47.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>

                    <div class="p-4 rounded-2xl bg-white border border-brand-border flex items-center justify-between shadow-xs">
                        <div>
                            <span class="font-bold text-brand-espresso text-sm block">Grade C-3</span>
                            <span class="text-[11px] text-stone-400 line-through">Rp 50.000</span>
                        </div>
                        <span class="font-serif font-extrabold text-base text-brand-gold">Rp 45.000<span class="text-[10px] font-normal text-brand-muted">/kg</span></span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-white border border-brand-border flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-truck-ramp-box text-brand-gold text-lg"></i>
                        <span class="text-brand-muted">
                            <strong>Aturan Pengantaran Armada:</strong> Pesanan &lt; 300 Kg otomatis menggunakan <strong>Pick Up</strong>. Untuk pesanan &ge; 300 Kg dialokasikan <strong>Tambahan Armada Truk Kargo</strong>.
                        </span>
                    </div>
                    <a href="{{ route('keranjang') }}" class="font-bold text-brand-gold hover:underline shrink-0">
                        Cek Keranjang Belanja &rarr;
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section id="koleksi-produk" class="py-14 sm:py-20 border-b border-brand-border bg-brand-surface relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="px-3.5 py-1 rounded-full bg-amber-50 text-brand-gold border border-brand-gold/30 text-xs font-bold uppercase tracking-wider inline-block">
                    Etalase Siap Kirim
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1a0f07] tracking-tight">
                    Varietas Tembakau Rajangan Unggulan
                </h2>
                <p class="text-xs sm:text-sm text-brand-muted">
                    Pilihan varietas tembakau rajangan halus berkualitas pilihan sentra pengolahan siap dikirim dalam partai bal maupun eceran.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="p-6 rounded-3xl border border-brand-border bg-white flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                        <div>
                            <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                                @if ($product->image_url ?? $product->image)
                                    <img src="{{ $product->image_url ?? asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-stone-300 text-3xl">
                                        <i class="fa-solid fa-leaf"></i>
                                    </div>
                                @endif
                                <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                    {{ $product->origin ?? 'Nusantara' }}
                                </span>
                                <span class="absolute bottom-2.5 right-2.5 px-2.5 py-0.5 rounded-full {{ $product->stock_kg > 0 ? 'bg-brand-dark/80 text-white' : 'bg-red-600/80 text-white' }} backdrop-blur-sm text-[10px] font-medium shadow">
                                    {{ $product->stock_kg > 0 ? 'Ready Stock' : 'Stok Habis' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[10px] font-bold">Grade {{ $product->grade ?? 'CW' }}</span>
                                <span class="text-[11px] text-brand-muted">Kadar Air {{ $product->moisture_content ?? '12–14%' }}</span>
                            </div>

                            <h3 class="font-serif font-extrabold text-lg text-[#1a0f07] mb-1.5">{{ $product->name }}</h3>
                            <p class="text-xs text-brand-muted leading-relaxed mb-4 line-clamp-2">
                                {{ $product->description ?? 'Varietas tembakau rajangan halus bermutu tinggi hasil pengolahan presisi sentra Serean.' }}
                            </p>

                            <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                                <div class="flex justify-between">
                                    <span>Varietas:</span>
                                    <strong class="text-brand-espresso">{{ $product->variety }}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span>Stok Siap Kirim:</span>
                                    <strong class="text-brand-espresso">{{ number_format($product->stock_kg) }} Kg</strong>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-brand-muted block uppercase">Harga Mulai</span>
                                <span class="font-serif font-bold text-base text-brand-espresso">Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                            </div>

                            @auth
                                <form action="{{ route('keranjang.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity_kg" value="1">
                                    <button type="submit" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                                        <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                        <span>Pesan</span>
                                    </button>
                                </form>
                            @else
                                <button type="button" onclick="openGuestAuthModal('{{ addslashes($product->name) }}')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                    <span>Pesan</span>
                                </button>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-12 text-center text-xs text-brand-muted bg-brand-surface rounded-3xl border border-brand-border">
                        Belum ada produk tembakau yang dipublikasikan di katalog etalase saat ini.
                    </div>
                @endforelse
            </div>

            <div id="modalGuestAuth" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
                <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative text-center">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-brand-gold border border-brand-gold/30 flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <h3 class="font-serif font-extrabold text-xl text-brand-espresso tracking-tight mb-2">
                        Silakan Masuk atau Buat Akun
                    </h3>
                    <p class="text-xs text-brand-muted leading-relaxed mb-6">
                        Untuk melakukan pemesanan produk tembakau pilihan <strong id="guestModalProductName" class="text-brand-espresso"></strong>, silakan masuk ke akun Anda atau daftarkan akun baru terlebih dahulu.
                    </p>

                    <div class="space-y-2.5">
                        <a href="{{ route('login') }}" class="w-full py-3 px-5 rounded-full bg-brand-espresso text-white text-xs font-bold hover:bg-brand-dark transition-all inline-flex items-center justify-center gap-2 shadow-sm">
                            <i class="fa-solid fa-arrow-right-to-bracket text-brand-gold text-xs"></i>
                            <span>Masuk ke Akun (Login)</span>
                        </a>
                        <a href="{{ route('register') }}" class="w-full py-3 px-5 rounded-full bg-brand-surface border border-brand-gold/40 text-brand-espresso text-xs font-bold hover:bg-amber-50 transition-all inline-flex items-center justify-center gap-2">
                            <i class="fa-solid fa-user-plus text-brand-gold text-xs"></i>
                            <span>Daftar Akun Baru (Register)</span>
                        </a>
                        <button type="button" onclick="document.getElementById('modalGuestAuth').classList.add('hidden')" class="w-full py-2.5 text-xs text-brand-muted hover:text-brand-espresso font-semibold transition-colors cursor-pointer">
                            Nanti Saja
                        </button>
                    </div>
                </div>
            </div>

            <script>
                function openGuestAuthModal(productName) {
                    document.getElementById('guestModalProductName').textContent = productName ? '"' + productName + '"' : '';
                    document.getElementById('modalGuestAuth').classList.remove('hidden');
                }
            </script>

            </div>

        </div>
    </section>

    <section class="py-14 sm:py-20 bg-white border-b border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-brand-surface border border-brand-border shadow-md flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="space-y-3 max-w-2xl text-center lg:text-left">
                    <span class="px-3 py-1 rounded-full bg-amber-50 text-brand-gold border border-brand-gold/30 text-xs font-bold uppercase tracking-wider inline-block">
                        Pengadaan Partai &amp; Ekspedisi Kargo
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-extrabold text-[#1a0f07] tracking-tight">
                        Konsultasi Pasokan Partai Besar &amp; Armada Logistik
                    </h2>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Kami melayani pasokan berkala bal-balan untuk pabrikan rokok, toko tembakau, dan pengrajin cerutu. Alokasi armada disesuaikan langsung dengan volume pesanan Anda (Pick Up untuk &lt; 300 Kg, dan Tambahan Armada Truk untuk &ge; 300 Kg).
                    </p>
                </div>
                <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('kontak') }}" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-full bg-brand-espresso text-white font-semibold text-xs sm:text-sm hover:bg-brand-dark transition-all shadow-sm">
                        Hubungi Sentra Serean
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

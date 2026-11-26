@extends('layouts.app')

@section('title', 'Katalog Produk Tembakau Nusantara — Serean Tobacco')
@section('meta_description', 'Katalog lengkap varietas tembakau Nusantara siap kirim: Virginia Flue-Cured, Temanggung Dark, Besuki Na-Oogst, Kasturi Madura, dan Srintil Super.')

@section('content')

    
    <section class="pt-28 sm:pt-36 pb-12 sm:pb-16 border-b border-brand-border bg-gradient-to-b from-brand-surface to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-3 shadow-sm">
                <i class="fa-solid fa-box-open text-xs"></i>
                <span>Katalog Lengkap Varietas Nusantara</span>
            </span>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#1a0f07] leading-tight max-w-4xl tracking-tight">
                Koleksi Tembakau Berkualitas, Siap Kirim Partai &amp; Eceran.
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-brand-muted mt-3 max-w-2xl leading-relaxed">
                Menyediakan aneka varietas tembakau legendaris dari sentra Temanggung dan nusantara dengan kadar air terjaga 12–14%, perajangan seragam, dan keaslian getah murni.
            </p>

            
            <div class="flex flex-wrap items-center gap-2 pt-6">
                <button type="button" onclick="filterCategory('all')" id="filter-all" class="filter-btn active px-4 py-2 rounded-full text-xs font-semibold bg-brand-espresso text-white transition-all shadow-sm">
                    Semua Varietas (5)
                </button>
                <button type="button" onclick="filterCategory('temanggung')" id="filter-temanggung" class="filter-btn px-4 py-2 rounded-full text-xs font-semibold bg-white text-brand-espresso border border-brand-border hover:border-brand-gold transition-all shadow-sm">
                    Temanggung &amp; Sumbing
                </button>
                <button type="button" onclick="filterCategory('jatim')" id="filter-jatim" class="filter-btn px-4 py-2 rounded-full text-xs font-semibold bg-white text-brand-espresso border border-brand-border hover:border-brand-gold transition-all shadow-sm">
                    Jawa Timur (Besuki &amp; Madura)
                </button>
                <button type="button" onclick="filterCategory('eksklusif')" id="filter-eksklusif" class="filter-btn px-4 py-2 rounded-full text-xs font-semibold bg-white text-brand-espresso border border-brand-border hover:border-brand-gold transition-all shadow-sm">
                    Grade Eksklusif / Srintil
                </button>
            </div>
        </div>
    </section>

    
    <section class="py-14 sm:py-20 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                
                
                <div class="product-item p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-category="temanggung">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/virginia-flue-cured.jpg') }}" alt="Virginia Flue-Cured" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Temanggung
                            </span>
                            <span class="absolute bottom-3 right-3 px-2.5 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Stok Ready
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[10px] font-bold">Grade A</span>
                            <span class="text-[11px] text-brand-muted">Kadar Air 12–13%</span>
                        </div>

                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] mb-2">Virginia Flue-Cured</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-4">
                            Warna kuning keemasan berkilau, aroma manis lembut alami, hisapan enteng tanpa sengatan di tenggorokan. Sangat diminati untuk racikan tingwe harian.
                        </p>

                        <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Karakter Rasa:</span>
                                <strong class="text-brand-espresso">Manis Lembut &amp; Harum</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Jenis Potongan:</span>
                                <strong class="text-brand-espresso">Rajang Mesin Halus (0.6mm)</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Minimal Order:</span>
                                <strong class="text-brand-espresso">1 kg (Eceran / Bal)</strong>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-lg text-brand-espresso">Rp 185.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <a href="{{ route('kontak') }}?produk=Virginia+Flue-Cured" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            <span>Pesan Sekarang</span>
                        </a>
                    </div>
                </div>

                
                <div class="product-item p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-category="temanggung">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/temanggung-dark.jpg') }}" alt="Temanggung Dark" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Lereng Sumbing
                            </span>
                            <span class="absolute bottom-3 right-3 px-2.5 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Stok Ready
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[10px] font-bold">Grade Super</span>
                            <span class="text-[11px] text-brand-muted">Kadar Air 13–14%</span>
                        </div>

                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] mb-2">Temanggung Dark</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-4">
                            Karakter rasa mantap dan gurih pekat hasil fermentasi getah daun tembakau lereng pegunungan tinggi Sumbing. Menghasilkan asap padat dengan aroma tembakau asli yang kuat.
                        </p>

                        <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Karakter Rasa:</span>
                                <strong class="text-brand-espresso">Mantap, Gurih &amp; Berbobot</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Jenis Potongan:</span>
                                <strong class="text-brand-espresso">Rajangan Sedang (0.8mm)</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Minimal Order:</span>
                                <strong class="text-brand-espresso">1 kg (Eceran / Bal)</strong>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-lg text-brand-espresso">Rp 230.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <a href="{{ route('kontak') }}?produk=Temanggung+Dark" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            <span>Pesan Sekarang</span>
                        </a>
                    </div>
                </div>

                
                <div class="product-item p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-category="jatim">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/besuki-na-oogst.jpg') }}" alt="Besuki Na-Oogst" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Jember
                            </span>
                            <span class="absolute bottom-3 right-3 px-2.5 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Ekspor Grade
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[10px] font-bold">Cerutu Standard</span>
                            <span class="text-[11px] text-brand-muted">Kadar Air 13%</span>
                        </div>

                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] mb-2">Besuki Na-Oogst</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-4">
                            Daun lentur berurat sangat halus, standar utama untuk pembungkus (wrapper/binder) cerutu dan rokok berkualitas ekspor dengan pembakaran abu putih sempurna.
                        </p>

                        <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Karakter Rasa:</span>
                                <strong class="text-brand-espresso">Halus, Elastis &amp; Bersih</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Bentuk Sediaan:</span>
                                <strong class="text-brand-espresso">Daun Utuh / Rajang Halus</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Minimal Order:</span>
                                <strong class="text-brand-espresso">1 kg (Eceran / Bal)</strong>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-lg text-brand-espresso">Rp 260.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <a href="{{ route('kontak') }}?produk=Besuki+Na-Oogst" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            <span>Pesan Sekarang</span>
                        </a>
                    </div>
                </div>

                
                <div class="product-item p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-category="jatim">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/kasturi-madura.jpg') }}" alt="Kasturi Madura" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Madura
                            </span>
                            <span class="absolute bottom-3 right-3 px-2.5 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Stok Ready
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[10px] font-bold">Aromatik Legendaris</span>
                            <span class="text-[11px] text-brand-muted">Kadar Air 12%</span>
                        </div>

                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] mb-2">Kasturi Madura</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-4">
                            Sensasi aroma gurih legendaris dengan daya bakar yang sangat seimbang. Tembakau awet disimpan lama tanpa mengalami perubahan cita rasa atau aroma getah.
                        </p>

                        <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Karakter Rasa:</span>
                                <strong class="text-brand-espresso">Gurih Pedas Ringan, Kering Alami</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Jenis Potongan:</span>
                                <strong class="text-brand-espresso">Rajang Mesin Halus (0.6mm)</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Minimal Order:</span>
                                <strong class="text-brand-espresso">1 kg (Eceran / Bal)</strong>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-lg text-brand-espresso">Rp 175.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <a href="{{ route('kontak') }}?produk=Kasturi+Madura" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            <span>Pesan Sekarang</span>
                        </a>
                    </div>
                </div>

                
                <div class="product-item p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-category="eksklusif">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/hero/daun-tembakau.jpg') }}" alt="Srintil Super Temanggung" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-brand-gold text-brand-dark text-[10px] font-bold uppercase tracking-wider shadow">
                                Kasta Tertinggi
                            </span>
                            <span class="absolute bottom-3 right-3 px-2.5 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Limited Stock
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="px-2 py-0.5 rounded-md bg-amber-200 text-brand-espresso text-[10px] font-bold">Kolektor Item</span>
                            <span class="text-[11px] text-brand-muted">Getah Resin Alami Pekat</span>
                        </div>

                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] mb-2">Srintil Super Temanggung</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-4">
                            Kasta tertinggi tembakau Temanggung lereng Sumbing dengan getah resin alami pekat. Beraroma wangi manis surgawi khas tanpa perlu tambahan saus kimia.
                        </p>

                        <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Karakter Rasa:</span>
                                <strong class="text-brand-espresso">Resin Pekat, Manis Harum Alami</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Jenis Potongan:</span>
                                <strong class="text-brand-espresso">Rajangan Presisi Halus (0.5mm)</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Minimal Order:</span>
                                <strong class="text-brand-espresso">0.5 kg / 1 kg</strong>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-lg text-brand-gold">Rp 450.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <a href="{{ route('kontak') }}?produk=Srintil+Super+Temanggung" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            <span>Pesan Sekarang</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-brand-surface border-b border-brand-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-white border border-brand-border shadow-md flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="space-y-3 max-w-2xl text-center lg:text-left">
                    <span class="px-3 py-1 rounded-full bg-amber-50 text-brand-gold border border-brand-gold/30 text-xs font-bold uppercase tracking-wider inline-block">
                        Kerjasama Pengadaan Partai
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-extrabold text-[#1a0f07] tracking-tight">
                        Butuh Pasokan Rutin Partai Besar (Bal-balan)?
                    </h2>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Kami melayani pasokan berkala untuk pengrajin cerutu, industri rokok kretek rumahan, dan distributor toko tembakau di seluruh kota. Dapatkan harga grosir khusus, kepastian pasokan panen, serta garansi mutu timbangan.
                    </p>
                </div>
                <div class="shrink-0 flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('kontak') }}" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-full bg-brand-espresso text-white font-semibold text-xs sm:text-sm hover:bg-brand-dark transition-all shadow-sm">
                        Konsultasi Pengadaan Partai
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function filterCategory(cat) {
            const items = document.querySelectorAll('.product-item');
            const buttons = document.querySelectorAll('.filter-btn');

            buttons.forEach(btn => {
                btn.classList.remove('bg-brand-espresso', 'text-white');
                btn.classList.add('bg-white', 'text-brand-espresso');
            });

            const activeBtn = document.getElementById(`filter-${cat}`);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-brand-espresso');
                activeBtn.classList.add('bg-brand-espresso', 'text-white');
            }

            items.forEach(item => {
                if (cat === 'all' || item.dataset.category === cat) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

@endsection

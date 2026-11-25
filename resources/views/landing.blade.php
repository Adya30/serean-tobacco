@extends('layouts.app')

@section('title', 'Serean Tobacco — Jasa & Tembakau Nusantara')
@section('meta_description', 'Serean Tobacco - Sentra Jasa Pengolahan dan Perdagangan Tembakau Pilihan Nusantara.')

@section('content')

    <!-- Hero Section (Tepat 100vh / Pas Layar dengan Background Bergelombang Coklat & Sinkronisasi 5 Detik) -->
    <section id="beranda" class="w-full h-screen h-[100dvh] max-h-screen flex flex-col justify-between pt-16 sm:pt-20 border-b border-brand-border relative overflow-hidden">
        
        <!-- Background Auto-Scroll 3 Gambar Menarik ke Samping (Tiap 5 Detik) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
            <div id="hero-bg-track" class="flex w-[300%] h-full transition-transform duration-1000 ease-in-out">
                <!-- Background 1: Daun Tembakau Kering Keemasan Premium -->
                <div class="w-1/3 h-full bg-cover bg-center shrink-0" style="background-image: url('{{ asset('images/hero/daun-tembakau.jpg') }}');"></div>
                <!-- Background 2: Panen Tembakau Daun Emas di Ladang -->
                <div class="w-1/3 h-full bg-cover bg-center shrink-0" style="background-image: url('{{ asset('images/hero/panen-tembakau-emas.jpg') }}');"></div>
                <!-- Background 3: Proses Curing & Pengeringan Tembakau -->
                <div class="w-1/3 h-full bg-cover bg-center shrink-0" style="background-image: url('{{ asset('images/hero/proses-tembakau.jpg') }}');"></div>
            </div>

            <!-- Bayangan Samar (Overlay Warm Gradient & Soft Vignette) -->
            <div class="absolute inset-0 bg-gradient-to-r from-brand-surface/90 via-brand-surface/75 to-brand-surface/60"></div>
            <div class="absolute inset-0 bg-brand-espresso/15"></div>
        </div>

        <!-- Foreground Content Layer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-auto w-full relative z-10 py-2 sm:py-4">
            <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6 lg:gap-10">
                
                <!-- Text Side (Sinkron Berganti Tiap 5 Detik) -->
                <div class="md:col-span-7 text-left order-2 md:order-1" data-aos="fade-up" data-aos-duration="700">
                    
                    <div class="relative min-h-[175px] sm:min-h-[210px] md:min-h-[220px]">
                        
                        <!-- Slide Text 0: Tembakau Pilihan -->
                        <div id="hero-text-0" class="hero-text-slide transition-all duration-700 opacity-100 translate-y-0 absolute inset-0 space-y-2.5 sm:space-y-3.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm border border-brand-border text-[11px] sm:text-xs font-semibold text-brand-gold uppercase tracking-wider shadow-sm">
                                <i class="fa-solid fa-leaf text-[10px]"></i>
                                <span>Jasa Rajang &amp; Perdagangan Tembakau</span>
                            </span>

                            <h1 class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-brand-espresso leading-snug">
                                Kualitas Tembakau Pilihan dengan Pengolahan Presisi.
                            </h1>

                            <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed max-w-xl">
                                Penyedia terpercaya tembakau berkualitas pilihan nusantara. Daun tembakau kering siap pakai dari sentra Temanggung dan berbagai daerah dengan aroma khas dan getah alami terjaga.
                            </p>
                        </div>

                        <!-- Slide Text 1: Petani Lereng Sumbing -->
                        <div id="hero-text-1" class="hero-text-slide transition-all duration-700 opacity-0 translate-y-3 pointer-events-none absolute inset-0 space-y-2.5 sm:space-y-3.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm border border-brand-border text-[11px] sm:text-xs font-semibold text-brand-gold uppercase tracking-wider shadow-sm">
                                <i class="fa-solid fa-mountain text-[10px]"></i>
                                <span>Petani Tradisional Lereng Sumbing</span>
                            </span>

                            <h1 class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-brand-espresso leading-snug">
                                Panen Terbaik dari Tangan Petani Nusantara.
                            </h1>

                            <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed max-w-xl">
                                Menghubungkan ratusan kelompok tani lokal dengan sistem grading jujur, timbangan akurat, serta kepastian pembayaran tunai transparan dan adil.
                            </p>
                        </div>

                        <!-- Slide Text 2: Proses Rajang & Curing Presisi -->
                        <div id="hero-text-2" class="hero-text-slide transition-all duration-700 opacity-0 translate-y-3 pointer-events-none absolute inset-0 space-y-2.5 sm:space-y-3.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm border border-brand-border text-[11px] sm:text-xs font-semibold text-brand-gold uppercase tracking-wider shadow-sm">
                                <i class="fa-solid fa-award text-[10px]"></i>
                                <span>Standar Ekspor &amp; Kadar Air Terjaga</span>
                            </span>

                            <h1 class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-[40px] font-bold text-brand-espresso leading-snug">
                                Perajangan Halus &amp; Pengeringan Curing 12–14%.
                            </h1>

                            <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed max-w-xl">
                                Pengeringan teratur menjaga getah murni tembakau pegunungan, siap memenuhi standar bahan baku lintingan hingga cerutu berkualitas ekspor.
                            </p>
                        </div>

                    </div>

                    <div class="flex flex-wrap items-center gap-3 pt-3">
                        <a href="#produk" class="px-5 sm:px-6 py-2.5 sm:py-3 rounded-full bg-brand-espresso text-white text-xs sm:text-sm font-semibold hover:bg-brand-dark transition-all duration-200 inline-flex items-center gap-2 shadow-sm hover:shadow">
                            <span>Lihat Produk</span>
                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-gold"></i>
                        </a>
                        <a href="#kontak" class="px-5 sm:px-6 py-2.5 sm:py-3 rounded-full bg-white text-brand-espresso border border-brand-border text-xs sm:text-sm font-semibold hover:border-brand-gold hover:bg-stone-50 transition-all duration-200 shadow-sm">
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Right Side: Aesthetic Photo / Showcase Cards (Sinkron Berganti Tiap 5 Detik) -->
                <div class="md:col-span-5 flex justify-center order-1 md:order-2" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="150">
                    <div class="relative w-44 sm:w-56 md:w-64 lg:w-72 aspect-square">
                        
                        <!-- Card Slide 0: Logo Resmi Serean Tobacco -->
                        <div id="hero-card-0" class="hero-card-slide transition-all duration-700 opacity-100 scale-100 absolute inset-0 rounded-2xl sm:rounded-3xl bg-white/95 backdrop-blur-md border-2 border-brand-border shadow-xl p-5 sm:p-7 flex flex-col items-center justify-center text-center group">
                            <img src="{{ asset('logo.png') }}" alt="Serean Tobacco" class="max-w-[85%] max-h-[75%] object-contain transition-transform duration-500 group-hover:scale-105">
                            <div class="mt-2.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-[10px] sm:text-[11px] font-semibold text-brand-espresso flex items-center gap-1.5 shadow-sm">
                                <i class="fa-solid fa-leaf text-brand-gold text-[10px]"></i>
                                <span>Tembakau Asli Temanggung</span>
                            </div>
                        </div>

                        <!-- Card Slide 1: Foto Estetik Panen & Petani Tembakau Emas -->
                        <div id="hero-card-1" class="hero-card-slide transition-all duration-700 opacity-0 scale-95 pointer-events-none absolute inset-0 rounded-2xl sm:rounded-3xl overflow-hidden border-2 border-brand-border shadow-xl group">
                            <img src="{{ asset('images/hero/panen-tembakau-emas.jpg') }}" alt="Panen Daun Tembakau Emas Temanggung" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-3 sm:bottom-4 inset-x-3 sm:inset-x-4 p-2.5 sm:p-3 rounded-2xl bg-white/90 backdrop-blur-md border border-white/60 shadow text-left">
                                <span class="text-[9px] sm:text-[10px] font-bold text-brand-gold uppercase tracking-wider block">Sentra Temanggung</span>
                                <h4 class="font-serif font-bold text-xs sm:text-sm text-brand-espresso leading-snug">Petani Lereng Sumbing</h4>
                                <p class="text-[10px] text-brand-muted mt-0.5">Sentra Tani Temanggung Asli</p>
                            </div>
                        </div>

                        <!-- Card Slide 2: Foto Estetik Proses Curing & Pengeringan Tembakau -->
                        <div id="hero-card-2" class="hero-card-slide transition-all duration-700 opacity-0 scale-95 pointer-events-none absolute inset-0 rounded-2xl sm:rounded-3xl overflow-hidden border-2 border-brand-border shadow-xl group">
                            <img src="{{ asset('images/hero/proses-tembakau.jpg') }}" alt="Proses Curing & Pengeringan Tembakau" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-3 sm:bottom-4 inset-x-3 sm:inset-x-4 p-2.5 sm:p-3 rounded-2xl bg-white/90 backdrop-blur-md border border-white/60 shadow text-left">
                                <span class="text-[9px] sm:text-[10px] font-bold text-brand-gold uppercase tracking-wider block">Standar Ekspor</span>
                                <h4 class="font-serif font-bold text-xs sm:text-sm text-brand-espresso leading-snug">Curing &amp; Rajang Presisi</h4>
                                <p class="text-[10px] text-brand-muted mt-0.5">Kadar Air 12–14% Terjaga</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Baris Statistik Coklat Lurus Elegan dengan Ornamen Emas (Lebih Ringkas & Ramping dengan Jarak ke Atas) -->
        <div class="w-full shrink-0 relative z-20 mt-4 sm:mt-6 lg:mt-8">
            <!-- Ornamen Garis Emas Klasik & Badge Tengah -->
            <div class="relative w-full flex items-center justify-center -mb-2.5 z-30 pointer-events-none">
                <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center gap-3">
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent via-brand-gold/60 to-brand-gold"></div>
                    <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-0.5 sm:py-1 rounded-full bg-brand-dark border border-brand-gold/70 shadow-lg text-brand-gold pointer-events-auto">
                        <span class="w-1 h-1 rotate-45 bg-brand-gold"></span>
                        <i class="fa-solid fa-leaf text-[10px]"></i>
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-[0.18em] text-white">Standar Mutu Tembakau Nusantara</span>
                        <span class="w-1 h-1 rotate-45 bg-brand-gold"></span>
                    </div>
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-brand-gold via-brand-gold/60 to-transparent"></div>
                </div>
            </div>

            <!-- Kontainer Statistik Coklat Lurus (Ukuran Proporsional & Lebih Ramping) -->
            <div class="w-full bg-[#2a170e] text-white border-y border-brand-gold/40 shadow-xl py-3 sm:py-4 lg:py-5 relative overflow-hidden">
                <div class="absolute inset-0 opacity-[0.06] bg-[radial-gradient(#d4a359_1px,transparent_1px)] [background-size:16px_16px]"></div>
                
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 text-center divide-y sm:divide-y-0 sm:divide-x divide-brand-gold/25">

                        <div class="py-1 px-2" data-aos="fade-up" data-aos-delay="50">
                            <p class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-brand-gold tracking-tight">12–14%</p>
                            <p class="text-[11px] sm:text-xs lg:text-sm font-semibold text-white tracking-wide uppercase mt-0.5">Kadar Air Terjaga</p>
                            <p class="text-[10px] sm:text-[11px] text-stone-300 font-normal mt-0.5">Pengeringan Curing Alami Ideal</p>
                        </div>

                        <div class="py-1 px-2 pt-2 sm:pt-1" data-aos="fade-up" data-aos-delay="100">
                            <p class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-brand-gold tracking-tight">25+</p>
                            <p class="text-[11px] sm:text-xs lg:text-sm font-semibold text-white tracking-wide uppercase mt-0.5">Varietas Daerah</p>
                            <p class="text-[10px] sm:text-[11px] text-stone-300 font-normal mt-0.5">Virginia, Besuki, Madura &amp; Temanggung</p>
                        </div>

                        <div class="py-1 px-2 pt-2 sm:pt-1" data-aos="fade-up" data-aos-delay="150">
                            <p class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-brand-gold tracking-tight">100%</p>
                            <p class="text-[11px] sm:text-xs lg:text-sm font-semibold text-white tracking-wide uppercase mt-0.5">Timbangan Akurat</p>
                            <p class="text-[10px] sm:text-[11px] text-stone-300 font-normal mt-0.5">Grading Transparan &amp; Mutu Jujur</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami (Diperkaya Gambar Tembakau, Narasi Lebih Bagus, & Icon Disesuaikan) -->
    <section id="tentang" class="w-full py-20 sm:py-28 lg:py-32 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <!-- Section Header -->
            <div class="max-w-3xl mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-3 shadow-sm">
                    <i class="fa-solid fa-leaf text-xs"></i>
                    <span>Tentang Serean Tobacco</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-espresso leading-snug">
                    Dedikasi pada Kualitas Rasa, Kejujuran Timbangan, dan Tradisi Temanggung.
                </h2>
            </div>

            <!-- Content Grid: Gambar Tembakau & Penjelasan Mendalam -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Col 1: Gambar Tembakau Showcase dengan Badge Kualitas -->
                <div class="lg:col-span-5" data-aos="fade-right" data-aos-duration="700">
                    <div class="relative group">
                        
                        <!-- Floating Accent Card (Dipindahkan ke pojok kanan atas agar tidak menimpa teks caption foto) -->
                        <div class="absolute -top-4 -right-3 sm:-right-5 z-20 bg-white/95 border border-brand-border/90 rounded-2xl shadow-xl p-3 sm:p-4 flex items-center gap-3 backdrop-blur-md transition-transform duration-300 group-hover:-translate-y-1">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-amber-50 border border-brand-gold/30 flex items-center justify-center text-brand-gold text-lg shrink-0 shadow-sm">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-bold text-brand-espresso">100% Tembakau Asli</p>
                                <p class="text-[10px] sm:text-[11px] text-brand-muted">Aroma Getah Murni Alami</p>
                            </div>
                        </div>

                        <!-- Main Image Box (Ukuran tinggi proporsional, tidak terlalu tinggi) -->
                        <div class="relative rounded-3xl overflow-hidden border-2 border-brand-border shadow-xl aspect-[4/3] max-h-[360px] sm:max-h-[380px] bg-stone-100">
                            <img src="{{ asset('images/hero/daun-tembakau.jpg') }}" alt="Daun Tembakau Asli Temanggung" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                            
                            <!-- Overlay Caption on Image -->
                            <div class="absolute bottom-0 inset-x-0 p-4 sm:p-5 text-white">
                                <span class="px-2.5 py-0.5 rounded-full bg-brand-gold text-brand-dark text-[10px] sm:text-[11px] font-bold uppercase tracking-wider inline-block mb-1 shadow">
                                    Grade Pilihan
                                </span>
                                <h4 class="font-serif text-base sm:text-lg font-bold leading-snug">Daun Tembakau Asli Temanggung</h4>
                                <p class="text-[11px] sm:text-xs text-stone-200 mt-0.5 leading-relaxed">Dipetik pada kematangan optimal di lereng Gunung Sumbing &amp; Sindoro.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Col 2: Penjelasan Lebih Bagus & 3 Icon Keunggulan yang Disesuaikan -->
                <div class="lg:col-span-7 space-y-6" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                    
                    <div class="space-y-4 text-sm sm:text-base lg:text-lg text-brand-muted leading-relaxed">
                        <p>
                            <strong class="text-brand-espresso font-semibold">Serean Tobacco</strong> berakar di Temanggung, Jawa Tengah—daerah yang diakui sebagai sentra tembakau paling berkarakter di Nusantara. Dikelilingi iklim sejuk lereng Gunung Sumbing dan Sindoro, tembakau yang kami hasilkan memiliki getah kental, warna keemasan, dan aroma gurih yang khas.
                        </p>
                        <p class="text-xs sm:text-sm md:text-base">
                            Kami hadir menjembatani kerja keras petani lokal dengan pengrajin lintingan, industri rokok rumahan, hingga penikmat tembakau mandiri. Melalui sistem grading terbuka, timbangan digital akurat, dan kontrol pascapanen yang disiplin, setiap helai tembakau siap digunakan tanpa kekhawatiran jamur atau mutu yang menurun.
                        </p>
                    </div>

                    <!-- 3 Kartu Keunggulan dengan Icon Disesuaikan & Penjelasan Lebih Rinci -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        
                        <!-- 1. Jasa Rajang Presisi -->
                        <div class="p-5 rounded-2xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-border flex items-center justify-center text-brand-gold mb-3 text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                                <i class="fa-solid fa-scissors"></i>
                            </div>
                            <h3 class="font-serif font-bold text-brand-espresso text-base mb-1.5">Perajangan Mesin</h3>
                            <p class="text-xs text-brand-muted leading-relaxed">Potongan seragam dari halus (0.6mm) hingga sedang, menjaga hisapan lintingan halus tanpa debu.</p>
                        </div>

                        <!-- 2. Curing Alami Bambu Widig -->
                        <div class="p-5 rounded-2xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-border flex items-center justify-center text-brand-gold mb-3 text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                                <i class="fa-solid fa-sun"></i>
                            </div>
                            <h3 class="font-serif font-bold text-brand-espresso text-base mb-1.5">Curing Alami</h3>
                            <p class="text-xs text-brand-muted leading-relaxed">Pengeringan terukur di atas anyaman bambu widig, menjaga getah asli dan kadar air stabil 12–14%.</p>
                        </div>

                        <!-- 3. Kemasan Kedap & Higienis -->
                        <div class="p-5 rounded-2xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-border flex items-center justify-center text-brand-gold mb-3 text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <h3 class="font-serif font-bold text-brand-espresso text-base mb-1.5">Kemasan Kedap</h3>
                            <p class="text-xs text-brand-muted leading-relaxed">Pengemasan berlapis higienis tahan lembap, menjaga kesegaran rasa tembakau hingga ke tangan Anda.</p>
                        </div>

                    </div>

                    <!-- Jaminan Mutu Singkat -->
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-6 pt-3 text-xs sm:text-sm font-semibold text-brand-espresso border-t border-brand-border/70">
                        <span class="inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check text-brand-gold"></i>
                            <span>Bebas Campuran Kimia</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check text-brand-gold"></i>
                            <span>Langsung Petani Temanggung</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check text-brand-gold"></i>
                            <span>Siap Kirim Partai &amp; Eceran</span>
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Produk Pilihan (Carousel Horizontal dengan Gambar & Indikator Dot ke Samping) -->
    <section id="produk" class="w-full py-20 sm:py-28 lg:py-32 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <!-- Header Section dengan Tombol Navigasi Panah Geser -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 sm:mb-10" data-aos="fade-up">
                <div>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-2 shadow-sm">
                        <i class="fa-solid fa-box-open text-xs"></i>
                        <span>Katalog Pilihan</span>
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-espresso">
                        Varietas Tembakau Siap Kirim
                    </h2>
                </div>
                
                <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto">
                    <p class="text-xs sm:text-sm text-brand-muted max-w-xs">
                        Geser untuk varietas tembakau pilihan Nusantara lainnya.
                    </p>
                    <div class="flex items-center gap-2 shrink-0">
                        <button type="button" onclick="scrollProductTrack('left')" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-brand-border bg-brand-surface text-brand-espresso hover:bg-brand-espresso hover:text-white transition-all flex items-center justify-center shadow-sm" aria-label="Geser ke kiri">
                            <i class="fa-solid fa-arrow-left text-xs sm:text-sm"></i>
                        </button>
                        <button type="button" onclick="scrollProductTrack('right')" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-brand-border bg-brand-surface text-brand-espresso hover:bg-brand-espresso hover:text-white transition-all flex items-center justify-center shadow-sm" aria-label="Geser ke kanan">
                            <i class="fa-solid fa-arrow-right text-xs sm:text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Horizontal Scroll Track Produk (Tampil Pas 3 Produk di Desktop Tanpa Terpotong) -->
            <div id="product-scroll-track" class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory py-4 no-scrollbar">
                
                <!-- Card 1: Virginia Flue-Cured -->
                <div id="prod-card-0" class="w-full sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] shrink-0 snap-start p-5 sm:p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/virginia-flue-cured.jpg') }}" alt="Virginia Flue-Cured" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Temanggung
                            </span>
                            <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Stok Ready
                            </span>
                        </div>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso mb-1.5">Virginia Flue-Cured</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-5">
                            Warna kuning keemasan berkilau, aroma manis lembut alami, favorit untuk racikan lintingan harian.
                        </p>
                    </div>
                    <div class="pt-3.5 border-t border-brand-border flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-sm sm:text-base text-brand-espresso">Rp 185.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <button type="button" onclick="selectProduct('Virginia Flue-Cured')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm">
                            Pesan
                        </button>
                    </div>
                </div>

                <!-- Card 2: Temanggung Dark -->
                <div id="prod-card-1" class="w-full sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] shrink-0 snap-start p-5 sm:p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/temanggung-dark.jpg') }}" alt="Temanggung Dark" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Lereng Sumbing
                            </span>
                            <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Stok Ready
                            </span>
                        </div>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso mb-1.5">Temanggung Dark</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-5">
                            Karakter rasa mantap dan gurih pekat hasil fermentasi getah daun tembakau lereng pegunungan tinggi.
                        </p>
                    </div>
                    <div class="pt-3.5 border-t border-brand-border flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-sm sm:text-base text-brand-espresso">Rp 230.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <button type="button" onclick="selectProduct('Temanggung Dark')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm">
                            Pesan
                        </button>
                    </div>
                </div>

                <!-- Card 3: Besuki Na-Oogst -->
                <div id="prod-card-2" class="w-full sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] shrink-0 snap-start p-5 sm:p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/besuki-na-oogst.jpg') }}" alt="Besuki Na-Oogst" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Jember
                            </span>
                            <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Ekspor Grade
                            </span>
                        </div>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso mb-1.5">Besuki Na-Oogst</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-5">
                            Daun lentur berurat sangat halus, standar utama untuk pembungkus cerutu dan rokok kualitas ekspor.
                        </p>
                    </div>
                    <div class="pt-3.5 border-t border-brand-border flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-sm sm:text-base text-brand-espresso">Rp 260.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <button type="button" onclick="selectProduct('Besuki Na-Oogst')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm">
                            Pesan
                        </button>
                    </div>
                </div>

                <!-- Card 4: Kasturi Madura -->
                <div id="prod-card-3" class="w-full sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] shrink-0 snap-start p-5 sm:p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/products/kasturi-madura.jpg') }}" alt="Kasturi Madura" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                Madura
                            </span>
                            <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Stok Ready
                            </span>
                        </div>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso mb-1.5">Kasturi Madura</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-5">
                            Sensasi aroma gurih legendaris dengan pembakaran seimbang, awet disimpan tanpa perubahan rasa.
                        </p>
                    </div>
                    <div class="pt-3.5 border-t border-brand-border flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-sm sm:text-base text-brand-espresso">Rp 175.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <button type="button" onclick="selectProduct('Kasturi Madura')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm">
                            Pesan
                        </button>
                    </div>
                </div>

                <!-- Card 5: Srintil Super Temanggung -->
                <div id="prod-card-4" class="w-full sm:w-[calc((100%-1.5rem)/2)] lg:w-[calc((100%-3rem)/3)] shrink-0 snap-start p-5 sm:p-6 rounded-3xl border border-brand-border bg-brand-surface flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                    <div>
                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                            <img src="{{ asset('images/hero/daun-tembakau.jpg') }}" alt="Srintil Super Temanggung" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-brand-gold text-brand-dark text-[10px] font-bold uppercase tracking-wider shadow">
                                Kasta Tertinggi
                            </span>
                            <span class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded-full bg-brand-dark/80 backdrop-blur-sm text-[10px] font-medium text-white shadow">
                                Limited
                            </span>
                        </div>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso mb-1.5">Srintil Super Temanggung</h3>
                        <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mb-5">
                            Kasta tertinggi tembakau Temanggung lereng Sumbing dengan getah resin alami pekat beraroma khas surgawi.
                        </p>
                    </div>
                    <div class="pt-3.5 border-t border-brand-border flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-brand-muted block uppercase tracking-wider">Harga Mulai</span>
                            <span class="font-bold text-sm sm:text-base text-brand-gold">Rp 450.000<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                        </div>
                        <button type="button" onclick="selectProduct('Srintil Super Temanggung')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm">
                            Pesan
                        </button>
                    </div>
                </div>

            </div>

            <!-- Tanda Dot Indikator Geser ke Samping (3 Tampilan Geser) -->
            <div class="flex items-center justify-center gap-2 mt-6 sm:mt-8">
                <button type="button" onclick="scrollProductToIndex(0)" id="prod-dot-0" class="prod-indicator w-8 h-2.5 rounded-full bg-brand-gold transition-all duration-300" aria-label="Tampilan 1"></button>
                <button type="button" onclick="scrollProductToIndex(1)" id="prod-dot-1" class="prod-indicator w-2.5 h-2.5 rounded-full bg-brand-espresso/20 hover:bg-brand-gold/60 transition-all duration-300" aria-label="Tampilan 2"></button>
                <button type="button" onclick="scrollProductToIndex(2)" id="prod-dot-2" class="prod-indicator w-2.5 h-2.5 rounded-full bg-brand-espresso/20 hover:bg-brand-gold/60 transition-all duration-300" aria-label="Tampilan 3"></button>
            </div>

        </div>
    </section>

    <!-- Testimoni (Alami, Tanpa Batasan 100vh, Container Lebar & Teks Besar) -->
    <section id="testimoni" class="w-full py-20 sm:py-28 lg:py-32 border-b border-brand-border relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-2 shadow-sm">
                    <i class="fa-solid fa-comments text-xs"></i>
                    <span>Testimoni Customer</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-espresso">
                    Apa Kata Customer Kami
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- Card 1: Budi Santoso -->
                <div class="p-6 sm:p-8 rounded-3xl bg-white border border-brand-border shadow-sm flex flex-col justify-between hover:shadow-xl hover:border-brand-gold transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <i class="fa-solid fa-quote-right text-brand-gold/25 text-xl group-hover:text-brand-gold/50 transition-colors"></i>
                        </div>
                        <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed mb-6 italic">
                            "Kadar air selalu konsisten di kisaran 13%. Tidak pernah ada masalah jamur saat dikirim ke luar kota. Mutu tembakau Serean sangat bisa diandalkan untuk racikan harian pelanggan kedai saya."
                        </p>
                    </div>
                    <div class="pt-4 border-t border-brand-border/70 flex items-center gap-3.5">
                        <img src="{{ asset('images/testimonials/budi-santoso.jpg') }}" alt="Budi Santoso" class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover border-2 border-brand-gold/60 shadow-sm shrink-0 group-hover:scale-105 transition-transform">
                        <div class="flex flex-col">
                            <h4 class="font-serif font-bold text-sm sm:text-base text-brand-espresso leading-snug">Budi Santoso</h4>
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">Pemilik Kedai Tingwe, Yogyakarta</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Pak Wardi -->
                <div class="p-6 sm:p-8 rounded-3xl bg-white border border-brand-border shadow-sm flex flex-col justify-between hover:shadow-xl hover:border-brand-gold transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <i class="fa-solid fa-quote-right text-brand-gold/25 text-xl group-hover:text-brand-gold/50 transition-colors"></i>
                        </div>
                        <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed mb-6 italic">
                            "Kualitas daun tembakau selalu prima dan timbangan sangat akurat. Pengiriman partai besar maupun kecil selalu tepat waktu, kemasannya rapi dan aman sampai tujuan."
                        </p>
                    </div>
                    <div class="pt-4 border-t border-brand-border/70 flex items-center gap-3.5">
                        <img src="{{ asset('images/testimonials/pak-wardi.jpg') }}" alt="Pak Wardi" class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover border-2 border-brand-gold/60 shadow-sm shrink-0 group-hover:scale-105 transition-transform">
                        <div class="flex flex-col">
                            <h4 class="font-serif font-bold text-sm sm:text-base text-brand-espresso leading-snug">Pak Wardi</h4>
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">Pelanggan Setia, Temanggung</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Hendro Ardianto -->
                <div class="p-6 sm:p-8 rounded-3xl bg-white border border-brand-border shadow-sm flex flex-col justify-between hover:shadow-xl hover:border-brand-gold transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <i class="fa-solid fa-quote-right text-brand-gold/25 text-xl group-hover:text-brand-gold/50 transition-colors"></i>
                        </div>
                        <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed mb-6 italic">
                            "Jasa rajang mesinnya luar biasa presisi dan seragam. Daun Besuki dan Madura yang saya pesan selalu harum dan bersih, sangat membantu efisiensi produksi cerutu rumahan saya."
                        </p>
                    </div>
                    <div class="pt-4 border-t border-brand-border/70 flex items-center gap-3.5">
                        <img src="{{ asset('images/testimonials/hendro-ardianto.jpg') }}" alt="Hendro Ardianto" class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover border-2 border-brand-gold/60 shadow-sm shrink-0 group-hover:scale-105 transition-transform">
                        <div class="flex flex-col">
                            <h4 class="font-serif font-bold text-sm sm:text-base text-brand-espresso leading-snug">Hendro Ardianto</h4>
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">Pengrajin Cerutu, Surabaya</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Kontak & Pemesanan (Alami, Tanpa Batasan 100vh, Container Lebar & Teks Besar) -->
    <section id="kontak" class="w-full py-20 sm:py-28 lg:py-32 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                
                <!-- Kontak Info -->
                <div class="lg:col-span-5 space-y-5" data-aos="fade-right" data-aos-duration="600">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider shadow-sm">
                        <i class="fa-solid fa-envelope text-xs"></i>
                        <span>Kontak Kami</span>
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-espresso leading-snug">
                        Pesan atau Konsultasikan Kebutuhan Anda
                    </h2>
                    <p class="text-sm sm:text-base text-brand-muted leading-relaxed">
                        Hubungi tim kami untuk pemesanan varietas tembakau, jasa rajang presisi, maupun penawaran hasil panen kebun Anda.
                    </p>

                    <div class="space-y-4 pt-4 text-sm sm:text-base text-brand-muted">
                        <p class="flex items-start gap-3.5">
                            <i class="fa-solid fa-location-dot text-brand-gold text-base mt-1"></i>
                            <span>Jl. Raya Temanggung - Parakan KM 4, Temanggung, Jawa Tengah</span>
                        </p>
                        <p class="flex items-center gap-3.5">
                            <i class="fa-solid fa-envelope text-brand-gold text-base"></i>
                            <span class="font-semibold text-brand-espresso">kemitraan@sereantobacco.co.id</span>
                        </p>
                        <p class="flex items-center gap-3.5">
                            <i class="fa-solid fa-phone text-brand-gold text-base"></i>
                            <span>(0293) 123-4567 • Sentra Layanan Pelanggan</span>
                        </p>
                    </div>
                </div>

                <!-- Form Pemesanan -->
                <div class="lg:col-span-7 p-7 sm:p-10 rounded-3xl bg-brand-surface border border-brand-border shadow-lg" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100">
                    <form onsubmit="handleSendOrder(event)" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-brand-espresso mb-1.5">Nama Lengkap</label>
                                <input type="text" id="name" required placeholder="Nama Anda" class="w-full px-4 py-3 text-sm sm:text-base rounded-xl border border-brand-border bg-white focus:outline-none focus:border-brand-gold shadow-sm">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-brand-espresso mb-1.5">Alamat Email</label>
                                <input type="email" id="email" required placeholder="nama@email.com" class="w-full px-4 py-3 text-sm sm:text-base rounded-xl border border-brand-border bg-white focus:outline-none focus:border-brand-gold shadow-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="productSelect" class="block text-sm font-semibold text-brand-espresso mb-1.5">Layanan / Produk</label>
                                <select id="productSelect" class="w-full px-4 py-3 text-sm sm:text-base rounded-xl border border-brand-border bg-white focus:outline-none focus:border-brand-gold shadow-sm">
                                    <option value="Virginia Flue-Cured">Virginia Flue-Cured</option>
                                    <option value="Temanggung Dark">Temanggung Dark</option>
                                    <option value="Besuki Na-Oogst">Besuki Na-Oogst</option>
                                    <option value="Kasturi Madura">Kasturi Madura</option>
                                    <option value="Srintil Super Temanggung">Srintil Super Temanggung</option>
                                    <option value="Jasa Rajang Presisi">Jasa Rajang Presisi</option>
                                    <option value="Jual Panen Petani">Tawarkan Hasil Panen Petani</option>
                                </select>
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-semibold text-brand-espresso mb-1.5">Jumlah Perkiraan</label>
                                <input type="text" id="quantity" placeholder="Contoh: 5 kg atau 2 bal" class="w-full px-4 py-3 text-sm sm:text-base rounded-xl border border-brand-border bg-white focus:outline-none focus:border-brand-gold shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-semibold text-brand-espresso mb-1.5">Catatan / Alamat Tujuan Pengiriman</label>
                            <textarea id="notes" rows="3" placeholder="Tuliskan kota tujuan atau permintaan spesifikasi tembakau khusus..." class="w-full px-4 py-3 text-sm sm:text-base rounded-xl border border-brand-border bg-white focus:outline-none focus:border-brand-gold shadow-sm"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-full bg-brand-espresso text-white text-sm sm:text-base font-semibold hover:bg-brand-dark transition-colors flex items-center justify-center gap-2.5 shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-paper-plane text-brand-gold text-base"></i>
                            <span>Kirim Pesan Pemesanan via Email</span>
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Auto-Scroll Synchronized Hero (Background, Teks, & Icon Card) Tiap 5 Detik
    (function () {
        let currentSlide = 0;
        const totalSlides = 3;
        const bgTrack = document.getElementById('hero-bg-track');

        function updateSlide(index) {
            currentSlide = index;

            // 1. Geser Background Track
            if (bgTrack) {
                bgTrack.style.transform = `translateX(-${currentSlide * (100 / totalSlides)}%)`;
            }

            // 2. Transisi Teks Hero (Title, Subtitle, Badge)
            for (let i = 0; i < totalSlides; i++) {
                const textEl = document.getElementById(`hero-text-${i}`);
                if (textEl) {
                    if (i === currentSlide) {
                        textEl.classList.remove('opacity-0', 'translate-y-3', 'pointer-events-none');
                        textEl.classList.add('opacity-100', 'translate-y-0');
                    } else {
                        textEl.classList.remove('opacity-100', 'translate-y-0');
                        textEl.classList.add('opacity-0', 'translate-y-3', 'pointer-events-none');
                    }
                }
            }

            // 3. Transisi Icon / Showcase Card Hero
            for (let i = 0; i < totalSlides; i++) {
                const cardEl = document.getElementById(`hero-card-${i}`);
                if (cardEl) {
                    if (i === currentSlide) {
                        cardEl.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                        cardEl.classList.add('opacity-100', 'scale-100');
                    } else {
                        cardEl.classList.remove('opacity-100', 'scale-100');
                        cardEl.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    }
                }
            }
        }

        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            updateSlide(next);
        }

        setInterval(nextSlide, 5000);
    })();

    // Product Carousel Scroll & Dots Controller
    const prodTrack = document.getElementById('product-scroll-track');
    const totalProdDots = 3;

    function updateProductDots(activeIndex) {
        for (let i = 0; i < totalProdDots; i++) {
            const dot = document.getElementById(`prod-dot-${i}`);
            if (dot) {
                if (i === activeIndex) {
                    dot.classList.add('w-8', 'bg-brand-gold');
                    dot.classList.remove('w-2.5', 'bg-brand-espresso/20');
                } else {
                    dot.classList.remove('w-8', 'bg-brand-gold');
                    dot.classList.add('w-2.5', 'bg-brand-espresso/20');
                }
            }
        }
    }

    function scrollProductTrack(direction) {
        if (!prodTrack) return;
        const card = document.getElementById('prod-card-0');
        const gap = 24; // gap-6
        const scrollAmount = card ? (card.offsetWidth + gap) : 340;
        prodTrack.scrollBy({ left: direction === 'left' ? -scrollAmount : scrollAmount, behavior: 'smooth' });
    }

    function scrollProductToIndex(index) {
        if (!prodTrack) return;
        const card = document.getElementById('prod-card-0');
        const gap = 24;
        const cardWidth = card ? (card.offsetWidth + gap) : 340;
        prodTrack.scrollTo({ left: index * cardWidth, behavior: 'smooth' });
        updateProductDots(index);
    }

    if (prodTrack) {
        let scrollTimeout;
        prodTrack.addEventListener('scroll', function () {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                const scrollLeft = prodTrack.scrollLeft;
                const maxScroll = prodTrack.scrollWidth - prodTrack.clientWidth;
                if (maxScroll <= 0) return;
                const ratio = scrollLeft / maxScroll;
                const activeIndex = Math.min(totalProdDots - 1, Math.round(ratio * (totalProdDots - 1)));
                updateProductDots(activeIndex);
            }, 50);
        }, { passive: true });
    }

    // Select Product to Order
    function selectProduct(name) {
        const selectEl = document.getElementById('productSelect');
        if (selectEl) {
            for (let i = 0; i < selectEl.options.length; i++) {
                if (selectEl.options[i].value.includes(name)) {
                    selectEl.selectedIndex = i;
                    break;
                }
            }
        }
        const contactSection = document.getElementById('kontak');
        if (contactSection) {
            contactSection.scrollIntoView({ behavior: 'smooth' });
            const qtyInput = document.getElementById('quantity');
            if (qtyInput) setTimeout(() => qtyInput.focus(), 500);
        }
    }

    // Send via Email (mailto)
    function handleSendOrder(e) {
        e.preventDefault();
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const product = document.getElementById('productSelect').value;
        const quantity = document.getElementById('quantity').value.trim() || '1 kg';
        const notes = document.getElementById('notes').value.trim() || '-';

        const subject = encodeURIComponent(`Pemesanan Tembakau - ${name} (${product})`);
        const body = encodeURIComponent(`Halo Tim Serean Tobacco,\n\nSaya ingin memesan / berkonsultasi mengenai tembakau:\n- Nama: ${name}\n- Alamat Email: ${email}\n- Layanan / Produk: ${product}\n- Jumlah: ${quantity}\n- Catatan / Alamat Tujuan: ${notes}\n\nMohon informasi ketersediaan stok dan harga total. Terima kasih.`);

        window.location.href = `mailto:kemitraan@sereantobacco.co.id?subject=${subject}&body=${body}`;
    }
</script>
@endpush

@extends('layouts.app')

@section('title', 'Serean Tobacco — Jasa & Tembakau Nusantara')
@section('meta_description', 'Serean Tobacco - Sentra Jasa Pengolahan dan Perdagangan Tembakau Pilihan Nusantara.')

@section('content')


    <section id="beranda" class="w-full min-h-[100dvh] lg:h-[100dvh] lg:max-h-screen flex flex-col justify-between pt-20 sm:pt-24 lg:pt-20 border-b border-brand-border relative overflow-hidden">


        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
            <div id="hero-bg-track" class="flex w-[300%] h-full transition-transform duration-1000 ease-in-out">

                <div class="w-1/3 h-full bg-cover bg-center shrink-0" style="background-image: url('{{ asset('images/hero/daun-tembakau.jpg') }}');"></div>

                <div class="w-1/3 h-full bg-cover bg-center shrink-0" style="background-image: url('{{ asset('images/hero/panen-tembakau-emas.jpg') }}');"></div>

                <div class="w-1/3 h-full bg-cover bg-center shrink-0" style="background-image: url('{{ asset('images/hero/proses-tembakau.jpg') }}');"></div>
            </div>


            <div class="absolute inset-0 bg-gradient-to-r from-brand-surface/90 via-brand-surface/75 to-brand-surface/60"></div>
            <div class="absolute inset-0 bg-brand-espresso/15"></div>
        </div>


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-auto w-full relative z-10 py-3 sm:py-4">
            <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-5 sm:gap-6 lg:gap-10">


                <div class="md:col-span-7 text-center md:text-left order-2 md:order-1" data-aos="fade-up" data-aos-duration="700">

                    <div class="relative min-h-[190px] sm:min-h-[195px] md:min-h-[210px]">


                        <div id="hero-text-0" class="hero-text-slide transition-all duration-700 opacity-100 translate-y-0 absolute inset-0 space-y-2 sm:space-y-3 flex flex-col items-center md:items-start">
                            <div class="flex items-center gap-2 text-brand-gold pb-1 select-none pointer-events-none">
                                <svg class="w-32 sm:w-40 h-4 text-brand-gold" viewBox="0 0 160 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 8 C 25 15, 45 1, 65 8" stroke="#B07B27" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="80" cy="8" r="3" fill="#B07B27"/>
                                    <path d="M95 8 C 115 1, 135 15, 155 8" stroke="#B07B27" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>

                            <h1 class="font-serif text-xl sm:text-2xl md:text-3xl lg:text-[38px] font-extrabold text-[#1a0f07] leading-snug tracking-tight">
                                Kualitas Tembakau Pilihan dengan Pengolahan Presisi.
                            </h1>

                            <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed max-w-xl mx-auto md:mx-0">
                                Penyedia terpercaya tembakau berkualitas pilihan nusantara. Daun tembakau kering siap pakai dari sentra Temanggung dan berbagai daerah dengan aroma khas dan getah alami terjaga.
                            </p>
                        </div>


                        <div id="hero-text-1" class="hero-text-slide transition-all duration-700 opacity-0 translate-y-3 pointer-events-none absolute inset-0 space-y-2 sm:space-y-3 flex flex-col items-center md:items-start">
                            <div class="flex items-center gap-2 text-brand-gold pb-1 select-none pointer-events-none">
                                <svg class="w-32 sm:w-40 h-4 text-brand-gold" viewBox="0 0 160 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 8 C 25 15, 45 1, 65 8" stroke="#B07B27" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="80" cy="8" r="3" fill="#B07B27"/>
                                    <path d="M95 8 C 115 1, 135 15, 155 8" stroke="#B07B27" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>

                            <h1 class="font-serif text-xl sm:text-2xl md:text-3xl lg:text-[38px] font-extrabold text-[#1a0f07] leading-snug tracking-tight">
                                Panen Terbaik dari Tangan Petani Nusantara.
                            </h1>

                            <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed max-w-xl mx-auto md:mx-0">
                                Menghubungkan ratusan kelompok tani lokal dengan sistem grading jujur, timbangan akurat, serta kepastian pembayaran tunai transparan dan adil
                            </p>
                        </div>


                        <div id="hero-text-2" class="hero-text-slide transition-all duration-700 opacity-0 translate-y-3 pointer-events-none absolute inset-0 space-y-2 sm:space-y-3 flex flex-col items-center md:items-start">
                            <div class="flex items-center gap-2 text-brand-gold pb-1 select-none pointer-events-none">
                                <svg class="w-32 sm:w-40 h-4 text-brand-gold" viewBox="0 0 160 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 8 C 25 15, 45 1, 65 8" stroke="#B07B27" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="80" cy="8" r="3" fill="#B07B27"/>
                                    <path d="M95 8 C 115 1, 135 15, 155 8" stroke="#B07B27" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>

                            <h1 class="font-serif text-xl sm:text-2xl md:text-3xl lg:text-[38px] font-extrabold text-[#1a0f07] leading-snug tracking-tight">
                                Perajangan Halus &amp; Pengeringan Curing 12 - 14%
                            </h1>

                            <p class="text-xs sm:text-sm md:text-base text-brand-muted leading-relaxed max-w-xl mx-auto md:mx-0">
                                Pengeringan teratur menjaga getah murni tembakau pegunungan, siap memenuhi standar bahan baku lintingan hingga cerutu berkualitas ekspor
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center justify-center md:justify-start gap-2.5 sm:gap-3 pt-3 sm:pt-4">
                        <a href="{{ route('produk') }}" class="px-4 sm:px-6 py-2.5 sm:py-3 rounded-full bg-brand-espresso text-white text-xs sm:text-sm font-semibold hover:bg-brand-dark transition-all duration-200 inline-flex items-center gap-2 shadow-sm hover:shadow">
                            <span>Lihat Produk</span>
                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-gold"></i>
                        </a>
                        <a href="{{ route('kontak') }}" class="px-4 sm:px-6 py-2.5 sm:py-3 rounded-full bg-white text-brand-espresso border border-brand-border text-xs sm:text-sm font-semibold hover:border-brand-gold hover:bg-stone-50 transition-all duration-200 shadow-sm">
                            Hubungi Kami
                        </a>
                    </div>
                </div>


                <div class="md:col-span-5 flex justify-center order-1 md:order-2" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="150">
                    <div class="w-36 sm:w-48 md:w-60 lg:w-72 aspect-square rounded-2xl sm:rounded-3xl bg-white/95 backdrop-blur-md border-2 border-brand-border shadow-xl p-4 sm:p-7 flex flex-col items-center justify-center text-center group">
                        <img src="{{ asset('logo.png') }}" alt="Serean Tobacco" class="max-w-[85%] max-h-[75%] object-contain transition-transform duration-500 group-hover:scale-105">
                        <div class="mt-2 sm:mt-2.5 px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full bg-brand-surface border border-brand-border text-[9px] sm:text-[11px] font-semibold text-brand-espresso flex items-center gap-1.5 shadow-sm">
                            <i class="fa-solid fa-leaf text-brand-gold text-[9px] sm:text-[10px]"></i>
                            <span>Tembakau Asli Temanggung</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="w-full shrink-0 relative z-20 mt-3 sm:mt-5 lg:mt-6">

            <div class="relative w-full flex items-center justify-center -mb-2.5 z-30 pointer-events-none">
                <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-center gap-2 sm:gap-3">
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent via-brand-gold/60 to-brand-gold"></div>
                    <div class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-0.5 rounded-full bg-brand-dark border border-brand-gold/70 shadow-lg text-brand-gold pointer-events-auto">
                        <span class="w-1 h-1 rotate-45 bg-brand-gold"></span>
                        <i class="fa-solid fa-leaf text-[9px] sm:text-[10px]"></i>
                        <span class="text-[8px] sm:text-[10px] font-bold uppercase tracking-[0.14em] sm:tracking-[0.18em] text-white whitespace-nowrap">Standar Mutu Tembakau Nusantara</span>
                        <span class="w-1 h-1 rotate-45 bg-brand-gold"></span>
                    </div>
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-brand-gold via-brand-gold/60 to-transparent"></div>
                </div>
            </div>


            <div class="w-full bg-[#2a170e] text-white border-y border-brand-gold/40 shadow-xl py-2.5 sm:py-3.5 lg:py-4 relative overflow-hidden">
                <div class="absolute inset-0 opacity-[0.06] bg-[radial-gradient(#d4a359_1px,transparent_1px)] [background-size:16px_16px]"></div>

                <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid grid-cols-3 gap-1 sm:gap-4 lg:gap-6 text-center divide-x divide-brand-gold/25">

                        <div class="py-1 px-1 sm:px-2" data-aos="fade-up" data-aos-delay="50">
                            <p class="font-serif text-base sm:text-2xl lg:text-3xl font-bold text-brand-gold tracking-tight">12–14%</p>
                            <p class="text-[9px] sm:text-xs lg:text-sm font-semibold text-white tracking-wide uppercase mt-0.5">Kadar Air</p>
                            <p class="text-[8px] sm:text-[11px] text-stone-300 font-normal mt-0.5">Curing Alami</p>
                        </div>

                        <div class="py-1 px-1 sm:px-2" data-aos="fade-up" data-aos-delay="100">
                            <p class="font-serif text-base sm:text-2xl lg:text-3xl font-bold text-brand-gold tracking-tight">25+</p>
                            <p class="text-[9px] sm:text-xs lg:text-sm font-semibold text-white tracking-wide uppercase mt-0.5">Varietas</p>
                            <p class="text-[8px] sm:text-[11px] text-stone-300 font-normal mt-0.5">Nusantara</p>
                        </div>

                        <div class="py-1 px-1 sm:px-2" data-aos="fade-up" data-aos-delay="150">
                            <p class="font-serif text-base sm:text-2xl lg:text-3xl font-bold text-brand-gold tracking-tight">100%</p>
                            <p class="text-[9px] sm:text-xs lg:text-sm font-semibold text-white tracking-wide uppercase mt-0.5">Timbangan</p>
                            <p class="text-[8px] sm:text-[11px] text-stone-300 font-normal mt-0.5">Mutu Jujur</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="tentang" class="w-full py-20 sm:py-28 lg:py-32 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">


            <div class="max-w-3xl mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-3 shadow-sm">
                    <i class="fa-solid fa-leaf text-xs"></i>
                    <span>Tentang Serean Tobacco</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1a0f07] leading-snug tracking-tight">
                    Dedikasi pada Kualitas Rasa, Kejujuran Timbangan, dan Tradisi Temanggung.
                </h2>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">


                <div class="lg:col-span-5" data-aos="fade-right" data-aos-duration="700">
                    <div class="relative group">


                        <div class="absolute -top-4 -right-3 sm:-right-5 z-20 bg-white/95 border border-brand-border/90 rounded-2xl shadow-xl p-3 sm:p-4 flex items-center gap-3 backdrop-blur-md transition-transform duration-300 group-hover:-translate-y-1">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-amber-50 border border-brand-gold/30 flex items-center justify-center text-brand-gold text-lg shrink-0 shadow-sm">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-bold text-brand-espresso">100% Tembakau Asli</p>
                                <p class="text-[10px] sm:text-[11px] text-brand-muted">Aroma Getah Murni Alami</p>
                            </div>
                        </div>


                        <div class="relative rounded-3xl overflow-hidden border-2 border-brand-border shadow-xl aspect-[4/3] max-h-[360px] sm:max-h-[380px] bg-stone-100">
                            <img src="{{ asset('images/hero/daun-tembakau.jpg') }}" alt="Daun Tembakau Asli Temanggung" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>


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


                <div class="lg:col-span-7 space-y-6" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">

                    <div class="space-y-4 text-sm sm:text-base lg:text-lg text-brand-muted leading-relaxed">
                        <p>
                            <strong class="text-brand-espresso font-semibold">Serean Tobacco</strong> berakar di Temanggung, Jawa Tengah—daerah yang diakui sebagai sentra tembakau paling berkarakter di Nusantara. Dikelilingi iklim sejuk lereng Gunung Sumbing dan Sindoro, tembakau yang kami hasilkan memiliki getah kental, warna keemasan, dan aroma gurih yang khas.
                        </p>
                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">


                        <div class="p-5 rounded-2xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-border flex items-center justify-center text-brand-gold mb-3 text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                                <i class="fa-solid fa-scissors"></i>
                            </div>
                            <h3 class="font-serif font-bold text-brand-espresso text-base mb-1.5">Perajangan Mesin</h3>
                            <p class="text-xs text-brand-muted leading-relaxed">Potongan seragam dari halus (0.6mm) hingga sedang, menjaga hisapan lintingan halus tanpa debu.</p>
                        </div>


                        <div class="p-5 rounded-2xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-border flex items-center justify-center text-brand-gold mb-3 text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                                <i class="fa-solid fa-sun"></i>
                            </div>
                            <h3 class="font-serif font-bold text-brand-espresso text-base mb-1.5">Curing Alami</h3>
                            <p class="text-xs text-brand-muted leading-relaxed">Pengeringan terukur di atas anyaman bambu widig, menjaga getah asli dan kadar air stabil 12–14%.</p>
                        </div>


                        <div class="p-5 rounded-2xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-200 group">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-border flex items-center justify-center text-brand-gold mb-3 text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <h3 class="font-serif font-bold text-brand-espresso text-base mb-1.5">Kemasan Kedap</h3>
                            <p class="text-xs text-brand-muted leading-relaxed">Pengemasan berlapis higienis tahan lembap, menjaga kesegaran rasa tembakau hingga ke tangan Anda.</p>
                        </div>

                    </div>


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


    <section id="produk" class="w-full py-20 sm:py-28 lg:py-32 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">


            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 sm:mb-10" data-aos="fade-up">
                <div>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-2 shadow-sm">
                        <i class="fa-solid fa-box-open text-xs"></i>
                        <span>Produk Tembakau</span>
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1a0f07] tracking-tight">
                        Varietas Tembakau Siap Kirim
                    </h2>
                </div>

                <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto">
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


            <div id="product-scroll-track" class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory py-4 no-scrollbar">


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


            <div class="flex items-center justify-center gap-2 mt-6 sm:mt-8">
                <button type="button" onclick="scrollProductToIndex(0)" id="prod-dot-0" class="prod-indicator w-8 h-2.5 rounded-full bg-brand-gold transition-all duration-300" aria-label="Tampilan 1"></button>
                <button type="button" onclick="scrollProductToIndex(1)" id="prod-dot-1" class="prod-indicator w-2.5 h-2.5 rounded-full bg-brand-espresso/20 hover:bg-brand-gold/60 transition-all duration-300" aria-label="Tampilan 2"></button>
                <button type="button" onclick="scrollProductToIndex(2)" id="prod-dot-2" class="prod-indicator w-2.5 h-2.5 rounded-full bg-brand-espresso/20 hover:bg-brand-gold/60 transition-all duration-300" aria-label="Tampilan 3"></button>
            </div>

        </div>
    </section>


    <section id="testimoni" class="w-full py-20 sm:py-28 lg:py-32 border-b border-brand-border relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-2 shadow-sm">
                    <i class="fa-solid fa-comments text-xs"></i>
                    <span>Testimoni Customer</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1a0f07] tracking-tight">
                    Apa Kata Customer Kami
                </h2>
            </div>

            @php
                $testimonials = [
                    [
                        'name' => 'Budi Santoso',
                        'role' => 'Pemilik Kedai Tingwe, Yogyakarta',
                        'text' => 'Kadar air selalu konsisten di kisaran 13%. Tidak pernah ada masalah jamur saat dikirim ke luar kota. Mutu tembakau Serean sangat bisa diandalkan untuk racikan harian pelanggan kedai saya.',
                    ],
                    [
                        'name' => 'Pak Wardi',
                        'role' => 'Pelanggan Setia, Temanggung',
                        'text' => 'Kualitas daun tembakau selalu prima dan timbangan sangat akurat. Pengiriman partai besar maupun kecil selalu tepat waktu, kemasannya rapi dan aman sampai tujuan.',
                    ],
                    [
                        'name' => 'Hendro Ardianto',
                        'role' => 'Pengrajin Cerutu, Surabaya',
                        'text' => 'Jasa rajang mesinnya luar biasa presisi dan seragam. Daun Besuki dan Madura yang saya pesan selalu harum dan bersih, sangat membantu efisiensi produksi cerutu rumahan saya.',
                    ],
                ];
            @endphp

            <div class="relative overflow-hidden">
                <div id="testimoni-track" class="flex overflow-x-auto snap-x snap-mandatory gap-6 no-scrollbar pb-3 scroll-smooth">
                    @foreach ($testimonials as $index => $item)
                        <div id="testimoni-card-{{ $index }}" class="w-[88%] sm:w-[46%] lg:w-[31.5%] shrink-0 snap-start p-6 sm:p-8 rounded-3xl bg-white border border-brand-border shadow-sm flex flex-col justify-between hover:shadow-xl hover:border-brand-gold transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
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
                                    "{{ $item['text'] }}"
                                </p>
                            </div>
                            <div class="pt-4 border-t border-brand-border/70 flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-full bg-brand-gold/15 text-brand-gold flex items-center justify-center font-bold text-base shrink-0 border border-brand-gold/30">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="font-serif font-bold text-sm sm:text-base text-brand-espresso leading-snug">{{ $item['name'] }}</h4>
                                    <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">{{ $item['role'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if (count($testimonials) > 3)
                    <div id="testimoni-dots-container" class="flex items-center justify-center gap-2 pt-6">
                        @foreach ($testimonials as $index => $item)
                            <button type="button" onclick="scrollTestimoniToIndex({{ $index }})" id="testimoni-dot-{{ $index }}" class="testimoni-dot {{ $index === 0 ? 'w-7 bg-brand-espresso' : 'w-2 bg-brand-border' }} h-2 rounded-full hover:bg-brand-gold transition-all duration-300 cursor-pointer" aria-label="Testimoni {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </section>


    <section id="faq" class="w-full py-16 sm:py-24 bg-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">


            <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-3 shadow-sm">
                    <i class="fa-solid fa-circle-question text-xs"></i>
                    <span>Tanya Jawab (FAQ)</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#1a0f07] leading-snug tracking-tight">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="text-xs sm:text-sm md:text-base text-brand-muted mt-2 max-w-xl mx-auto leading-relaxed">
                    Jawaban seputar minimal pemesanan, sampel mutu, garansi kadar air, varietas tembakau, dan ekspedisi kargo Nusantara.
                </p>
            </div>


            <div class="space-y-4 sm:space-y-5" data-aos="fade-up" data-aos-delay="100">


                <div class="faq-item rounded-3xl border border-brand-border bg-brand-surface overflow-hidden shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300">
                    <button type="button" onclick="toggleFaq(0)" class="w-full py-5 sm:py-6 px-6 sm:px-8 flex items-center justify-between text-left gap-4 font-serif font-extrabold text-base sm:text-lg md:text-xl text-[#1a0f07] hover:text-brand-gold transition-colors focus:outline-none">
                        <span>Berapa batas minimal pemesanan tembakau di Serean Tobacco?</span>
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white border border-brand-border flex items-center justify-center shrink-0 text-brand-gold text-sm shadow-sm transition-transform duration-300" id="faq-icon-0">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div id="faq-ans-0" class="hidden px-6 sm:px-8 pb-6 pt-2 text-sm sm:text-base text-brand-muted leading-relaxed border-t border-brand-border/60">
                        Kami melayani pembelian mulai dari <strong>1 kg</strong> untuk kebutuhan eceran atau toko ritel tingwe, hingga puluhan <strong>bal dan ton</strong> untuk kebutuhan industri pabrik rokok dan gudang tembakau.
                    </div>
                </div>


                <div class="faq-item rounded-3xl border border-brand-border bg-brand-surface overflow-hidden shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300">
                    <button type="button" onclick="toggleFaq(1)" class="w-full py-5 sm:py-6 px-6 sm:px-8 flex items-center justify-between text-left gap-4 font-serif font-extrabold text-base sm:text-lg md:text-xl text-[#1a0f07] hover:text-brand-gold transition-colors focus:outline-none">
                        <span>Bagaimana jaminan mutu dan kadar air 12–14% saat pengiriman?</span>
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white border border-brand-border flex items-center justify-center shrink-0 text-brand-gold text-sm shadow-sm transition-transform duration-300" id="faq-icon-1">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div id="faq-ans-1" class="hidden px-6 sm:px-8 pb-6 pt-2 text-sm sm:text-base text-brand-muted leading-relaxed border-t border-brand-border/60">
                        Setiap daun tembakau diproses melalui pengeringan alami (curing) yang teratur dan diuji menggunakan <em>moisture meter</em> digital sebelum dikemas. Tembakau dibungkus dalam plastik berlapis kedap udara (<em>airtight barrier</em>) tahan lembap sehingga mutunya stabil dan tidak berjamur selama perjalanan jauh.
                    </div>
                </div>


                <div class="faq-item rounded-3xl border border-brand-border bg-brand-surface overflow-hidden shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300">
                    <button type="button" onclick="toggleFaq(2)" class="w-full py-5 sm:py-6 px-6 sm:px-8 flex items-center justify-between text-left gap-4 font-serif font-extrabold text-base sm:text-lg md:text-xl text-[#1a0f07] hover:text-brand-gold transition-colors focus:outline-none">
                        <span>Apakah bisa meminta paket sampel mutu (tester) terlebih dahulu?</span>
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white border border-brand-border flex items-center justify-center shrink-0 text-brand-gold text-sm shadow-sm transition-transform duration-300" id="faq-icon-2">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div id="faq-ans-2" class="hidden px-6 sm:px-8 pb-6 pt-2 text-sm sm:text-base text-brand-muted leading-relaxed border-t border-brand-border/60">
                        Tentu bisa. Kami menyediakan paket sampel tester mulai dari <strong>100 gram sampai 250 gram</strong> bagi mitra baru atau penikmat yang ingin menguji aroma, karakter rasa, dan kehalusan rajangan sebelum memutuskan membeli dalam jumlah partai besar.
                    </div>
                </div>


                <div class="faq-item rounded-3xl border border-brand-border bg-brand-surface overflow-hidden shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300">
                    <button type="button" onclick="toggleFaq(3)" class="w-full py-5 sm:py-6 px-6 sm:px-8 flex items-center justify-between text-left gap-4 font-serif font-extrabold text-base sm:text-lg md:text-xl text-[#1a0f07] hover:text-brand-gold transition-colors focus:outline-none">
                        <span>Varietas tembakau apa saja yang selalu tersedia di gudang?</span>
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white border border-brand-border flex items-center justify-center shrink-0 text-brand-gold text-xs shadow-sm transition-transform duration-300" id="faq-icon-3">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div id="faq-ans-3" class="hidden px-6 sm:px-8 pb-6 pt-2 text-sm sm:text-base text-brand-muted leading-relaxed border-t border-brand-border/60">
                        Kami menyediakan Virginia Flue-Cured keemasan (aroma manis lembut), Temanggung Dark lereng Sumbing (karakter mantap berbobot), Besuki Na-Oogst untuk cerutu mutu ekspor, Kasturi Madura (aroma gurih alami), hingga Srintil Super grade koleksi langka.
                    </div>
                </div>


                <div class="faq-item rounded-3xl border border-brand-border bg-brand-surface overflow-hidden shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300">
                    <button type="button" onclick="toggleFaq(4)" class="w-full py-5 sm:py-6 px-6 sm:px-8 flex items-center justify-between text-left gap-4 font-serif font-extrabold text-base sm:text-lg md:text-xl text-[#1a0f07] hover:text-brand-gold transition-colors focus:outline-none">
                        <span>Ekspedisi apa yang digunakan untuk pengiriman ke luar pulau Jawa?</span>
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white border border-brand-border flex items-center justify-center shrink-0 text-brand-gold text-sm shadow-sm transition-transform duration-300" id="faq-icon-4">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div id="faq-ans-4" class="hidden px-6 sm:px-8 pb-6 pt-2 text-sm sm:text-base text-brand-muted leading-relaxed border-t border-brand-border/60">
                        Kami bekerja sama dengan ekspedisi kargo khusus seperti Indah Logistik Kargo, J&amp;T Cargo, Dakota Cargo, dan JNE Trucking untuk menjangkau Sumatera, Kalimantan, Sulawesi, Bali, dan seluruh pelosok Nusantara dengan tarif hemat dan nomor resi transparan.
                    </div>
                </div>


                <div class="faq-item rounded-3xl border border-brand-border bg-brand-surface overflow-hidden shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300">
                    <button type="button" onclick="toggleFaq(5)" class="w-full py-5 sm:py-6 px-6 sm:px-8 flex items-center justify-between text-left gap-4 font-serif font-extrabold text-base sm:text-lg md:text-xl text-[#1a0f07] hover:text-brand-gold transition-colors focus:outline-none">
                        <span>Bagaimana cara melakukan pemesanan atau konsultasi langsung?</span>
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white border border-brand-border flex items-center justify-center shrink-0 text-brand-gold text-sm shadow-sm transition-transform duration-300" id="faq-icon-5">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div id="faq-ans-5" class="hidden px-6 sm:px-8 pb-6 pt-2 text-sm sm:text-base text-brand-muted leading-relaxed border-t border-brand-border/60">
                        Anda dapat langsung menghubungi kontak resmi kami di <a href="https://wa.me/6287855320286" target="_blank" class="text-brand-gold font-bold underline">0878-5532-0286 (Rajif Fakhri / Feri)</a> atau mengunjungi <a href="{{ route('kontak') }}" class="text-brand-gold font-bold underline">Halaman Kontak</a> untuk melihat direktori alamat sentra kami.
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    (function () {
        let currentSlide = 0;
        const totalSlides = 3;
        const bgTrack = document.getElementById('hero-bg-track');

        function updateSlide(index) {
            currentSlide = index;

            if (bgTrack) {
                bgTrack.style.transform = `translateX(-${currentSlide * (100 / totalSlides)}%)`;
            }

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
        }

        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            updateSlide(next);
        }

        setInterval(nextSlide, 5000);
    })();

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
        const gap = 24;
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

    function selectProduct(name) {
        const message = `Halo Serean Tobacco, saya tertarik dan ingin memesan varietas tembakau: ${name}. Mohon informasi ketersediaan stok dan harga per kg. Terima kasih.`;
        window.open(`https://wa.me/6287855320286?text=${encodeURIComponent(message)}`, '_blank');
    }

    function toggleFaq(index) {
        const ans = document.getElementById(`faq-ans-${index}`);
        const icon = document.getElementById(`faq-icon-${index}`);
        if (!ans) return;

        const isHidden = ans.classList.contains('hidden');
        for (let i = 0; i < 6; i++) {
            const a = document.getElementById(`faq-ans-${i}`);
            const ic = document.getElementById(`faq-icon-${i}`);
            if (a) a.classList.add('hidden');
            if (ic) ic.classList.remove('rotate-180');
        }

        if (isHidden) {
            ans.classList.remove('hidden');
            if (icon) icon.classList.add('rotate-180');
        }
    }

    const testimoniTrack = document.getElementById('testimoni-track');
    function scrollTestimoniToIndex(index) {
        if (!testimoniTrack) return;
        const cards = testimoniTrack.children;
        if (cards[index]) {
            cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
        }
        updateTestimoniDots(index);
    }

    function updateTestimoniDots(activeIndex) {
        const dots = document.querySelectorAll('.testimoni-dot');
        if (!dots.length) return;
        dots.forEach((dot, idx) => {
            if (idx === activeIndex) {
                dot.classList.remove('w-2', 'bg-brand-border');
                dot.classList.add('w-7', 'bg-brand-espresso');
            } else {
                dot.classList.remove('w-7', 'bg-brand-espresso');
                dot.classList.add('w-2', 'bg-brand-border');
            }
        });
    }

    if (testimoniTrack) {
        let tTimeout;
        testimoniTrack.addEventListener('scroll', () => {
            clearTimeout(tTimeout);
            tTimeout = setTimeout(() => {
                const dots = document.querySelectorAll('.testimoni-dot');
                if (!dots.length) return;
                const scrollLeft = testimoniTrack.scrollLeft;
                const cardWidth = testimoniTrack.firstElementChild ? (testimoniTrack.firstElementChild.offsetWidth + 24) : 340;
                const activeIndex = Math.min(dots.length - 1, Math.max(0, Math.round(scrollLeft / cardWidth)));
                updateTestimoniDots(activeIndex);
            }, 60);
        }, { passive: true });
    }
</script>
@endpush

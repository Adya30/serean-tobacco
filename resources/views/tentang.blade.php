@extends('layouts.app')

@section('title', 'Tentang Kami — Serean Tobacco Temanggung')
@section('meta_description', 'Mengenal Serean Tobacco: dedikasi menjaga mutu, keaslian getah tembakau lereng Sumbing & Sindoro, dan kejujuran timbangan.')

@section('content')

    
    <section class="pt-28 sm:pt-36 pb-14 sm:pb-20 border-b border-brand-border bg-gradient-to-b from-brand-surface to-white relative overflow-hidden">
        
        <div class="absolute -right-16 -bottom-16 w-80 h-80 opacity-[0.03] pointer-events-none select-none">
            <svg viewBox="0 0 100 160" fill="currentColor" class="w-full h-full text-brand-espresso">
                <path d="M50 5 C75 35, 82 85, 50 155 C18 85, 25 35, 50 5 Z"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-3 shadow-sm">
                <i class="fa-solid fa-leaf text-xs"></i>
                <span>Dedikasi &amp; Tradisi Temanggung</span>
            </span>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-espresso leading-tight max-w-4xl">
                Menjaga Kualitas Rasa, Kejujuran Timbangan, dan Tradisi Tembakau Nusantara.
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-brand-muted mt-4 max-w-2xl leading-relaxed">
                Berakar di lereng sejuk Gunung Sumbing dan Sindoro, kami mendedikasikan diri menghadirkan daun tembakau berkualitas murni langsung dari tangan petani untuk penikmat dan pengrajin di seluruh Indonesia.
            </p>
        </div>
    </section>

    
    <section class="py-16 sm:py-24 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                
                <div class="lg:col-span-5" data-aos="fade-right">
                    <div class="relative group">
                        
                        
                        <div class="absolute -top-3 -right-3 sm:-right-4 z-20 bg-white/95 border border-brand-border rounded-2xl shadow-xl p-3.5 flex items-center gap-3 backdrop-blur-md">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-brand-gold/30 flex items-center justify-center text-brand-gold text-lg shrink-0 shadow-sm">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-bold text-brand-espresso">100% Getah Alami</p>
                                <p class="text-[10px] text-brand-muted">Bebas Bahan Kimia</p>
                            </div>
                        </div>

                        <div class="relative rounded-3xl overflow-hidden border-2 border-brand-border shadow-xl aspect-[4/3] max-h-[380px] bg-stone-100">
                            <img src="{{ asset('images/hero/daun-tembakau.jpg') }}" alt="Daun Tembakau Temanggung Asli" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
                            
                            <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                                <span class="px-2.5 py-0.5 rounded-full bg-brand-gold text-brand-dark text-[10px] font-bold uppercase tracking-wider inline-block mb-1 shadow">
                                    Sentra Temanggung
                                </span>
                                <h3 class="font-serif text-lg font-bold">Gunung Sumbing &amp; Sindoro</h3>
                                <p class="text-xs text-stone-200 mt-0.5">Karakter rasa gurih kental berkat tanah vulkanik subur dan udara sejuk pegunungan.</p>
                            </div>
                        </div>

                    </div>
                </div>

                
                <div class="lg:col-span-7 space-y-6" data-aos="fade-left">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-xs font-semibold text-brand-gold uppercase tracking-wider">
                        <i class="fa-solid fa-history text-xs"></i>
                        <span>Kisah &amp; Dedikasi Kami</span>
                    </span>

                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-brand-espresso leading-snug">
                        Menghubungkan Kerja Keras Petani dengan Penikmat Tembakau Sejati.
                    </h2>

                    <div class="space-y-4 text-sm sm:text-base text-brand-muted leading-relaxed">
                        <p>
                            <strong class="text-brand-espresso font-semibold">Serean Tobacco</strong> lahir dari kecintaan mendalam terhadap kekayaan tradisi tembakau di Temanggung, Jawa Tengah—kawasan yang sejak berabad-abad diakui sebagai jantung penghasil tembakau terbaik di Nusantara.
                        </p>
                        <p>
                            Kami memahami bahwa kualitas rokok tingwe, lintingan rumahan, hingga cerutu bermutu tinggi sangat ditentukan oleh bahan baku yang jujur. Oleh karena itu, kami menerapkan standar pascapanen yang ketat: dari pemilihan daun pada kematangan optimal, perajangan presisi menggunakan mesin modern, hingga pengeringan alami di atas widig bambu yang menjaga kadar air stabil di kisaran 12–14%.
                        </p>
                        <p>
                            Bagi kami, setiap helai tembakau bukan sekadar komoditas dagang, melainkan titipan rasa, aroma, dan warisan budaya yang harus kami jaga kemurniannya sampai ke tangan Anda.
                        </p>
                    </div>

                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-2">
                        <div class="p-3 rounded-2xl bg-brand-surface border border-brand-border text-center">
                            <span class="font-serif font-bold text-lg sm:text-xl text-brand-gold block">100%</span>
                            <span class="text-xs text-brand-espresso font-semibold block mt-0.5">Timbangan Jujur</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-brand-surface border border-brand-border text-center">
                            <span class="font-serif font-bold text-lg sm:text-xl text-brand-gold block">12–14%</span>
                            <span class="text-xs text-brand-espresso font-semibold block mt-0.5">Kadar Air Terjaga</span>
                        </div>
                        <div class="p-3 rounded-2xl bg-brand-surface border border-brand-border text-center col-span-2 sm:col-span-1">
                            <span class="font-serif font-bold text-lg sm:text-xl text-brand-gold block">Murni</span>
                            <span class="text-xs text-brand-espresso font-semibold block mt-0.5">Tanpa Saus Kimia</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
    <section class="py-16 sm:py-24 border-b border-brand-border bg-brand-surface relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-2.5 shadow-sm">
                    <i class="fa-solid fa-star text-xs"></i>
                    <span>Prinsip Kerja Kami</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-espresso">
                    Empat Pilar Keunggulan Serean Tobacco
                </h2>
                <p class="text-xs sm:text-sm text-brand-muted mt-2 max-w-lg mx-auto">
                    Komitmen teguh yang membedakan kami dalam setiap helai dan kilogram tembakau yang kami kirimkan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                
                <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="50">
                    <div class="w-12 h-12 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-center text-brand-gold text-xl mb-4 group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso mb-2">Timbangan Digital Presisi</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Pengukuran berat digital transparan tanpa pengurangan sedikit pun. Anda mendapatkan bobot bersih persis sesuai dengan yang Anda pesan.
                    </p>
                </div>

                
                <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-center text-brand-gold text-xl mb-4 group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso mb-2">Curing Bambu Alami</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Pengeringan di atas anyaman bambu widig di bawah sinar matahari pegunungan menjaga keaslian getah dan mencegah timbulnya aroma gosong.
                    </p>
                </div>

                
                <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-12 h-12 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-center text-brand-gold text-xl mb-4 group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                        <i class="fa-solid fa-scissors"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso mb-2">Perajangan Mesin Halus</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Pisau mekanis berkecepatan teratur menghasilkan irisan rajangan seragam mulai 0.6mm, bebas dari serbuk dan gumpalan batang kasar.
                    </p>
                </div>

                
                <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-center text-brand-gold text-xl mb-4 group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso mb-2">Kemasan Kedap Higienis</h3>
                    <p class="text-xs sm:text-sm text-brand-muted leading-relaxed">
                        Penyegelan berlapis kedap udara menjaga kestabilan kadar air dan aroma murni tetap terkunci aman selama perjalanan ke seluruh Nusantara.
                    </p>
                </div>

            </div>

        </div>
    </section>

    
    <section class="py-16 sm:py-24 border-b border-brand-border bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-surface border border-brand-border text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-2.5 shadow-sm">
                    <i class="fa-solid fa-gears text-xs"></i>
                    <span>Alur Kerja Kami</span>
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-espresso">
                    Dari Kebun Pegunungan Hingga Siap Nikmat
                </h2>
                <p class="text-xs sm:text-sm text-brand-muted mt-2 max-w-lg mx-auto">
                    Tahapan cermat pengolahan tembakau untuk memastikan keseragaman mutu dan hisapan yang lembut.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                
                
                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border relative" data-aos="fade-up" data-aos-delay="50">
                    <div class="w-8 h-8 rounded-full bg-brand-gold text-brand-dark text-xs font-bold flex items-center justify-center mb-3 shadow">
                        01
                    </div>
                    <h4 class="font-serif font-bold text-base text-brand-espresso mb-1.5">Sortir &amp; Panen Daun Emas</h4>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Daun tembakau dipetik bertahap berdasarkan tingkat kematangan getah alami di lereng pegunungan.
                    </p>
                </div>

                
                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-8 h-8 rounded-full bg-brand-gold text-brand-dark text-xs font-bold flex items-center justify-center mb-3 shadow">
                        02
                    </div>
                    <h4 class="font-serif font-bold text-base text-brand-espresso mb-1.5">Pemeraman &amp; Fermentasi</h4>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Daun digulung rapi dan diperam selama beberapa hari untuk memunculkan aroma gurih manis khas tembakau.
                    </p>
                </div>

                
                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border relative" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-8 h-8 rounded-full bg-brand-gold text-brand-dark text-xs font-bold flex items-center justify-center mb-3 shadow">
                        03
                    </div>
                    <h4 class="font-serif font-bold text-base text-brand-espresso mb-1.5">Perajangan Mesin Presisi</h4>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Proses perajangan halus dengan pisau khusus berstandar ekspor untuk menghasilkan rajangan yang seragam.
                    </p>
                </div>

                
                <div class="p-6 rounded-3xl bg-brand-surface border border-brand-border relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-8 h-8 rounded-full bg-brand-gold text-brand-dark text-xs font-bold flex items-center justify-center mb-3 shadow">
                        04
                    </div>
                    <h4 class="font-serif font-bold text-base text-brand-espresso mb-1.5">Curing Alami &amp; Uji Mutu</h4>
                    <p class="text-xs text-brand-muted leading-relaxed">
                        Pengeringan di widig bambu hingga mencapai kadar air ideal 12–14%, kemudian disegel dalam kemasan kedap.
                    </p>
                </div>

            </div>

        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-brand-dark text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-brand-gold/40 text-xs sm:text-sm font-semibold text-brand-gold uppercase tracking-wider mb-4 shadow">
                <i class="fa-solid fa-box-open text-xs"></i>
                <span>Jelajahi Produk Kami</span>
            </span>
            <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-white max-w-2xl mx-auto leading-snug">
                Siap Menemukan Karakter Tembakau Pilihan untuk Racikan Anda?
            </h2>
            <p class="text-xs sm:text-sm md:text-base text-stone-300 max-w-xl mx-auto mt-3 leading-relaxed">
                Dari Virginia Flue-Cured yang harum lembut hingga Srintil kasta tertinggi lereng Sumbing, kami siap melayani pesanan eceran maupun partai besar.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3 pt-6">
                <a href="{{ route('produk') }}" class="px-6 py-3 rounded-full bg-brand-gold text-brand-dark font-bold text-xs sm:text-sm hover:bg-amber-400 transition-all shadow-lg inline-flex items-center gap-2">
                    <span>Lihat Katalog Produk</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
                <a href="{{ route('kontak') }}" class="px-6 py-3 rounded-full bg-white/10 text-white border border-white/20 font-semibold text-xs sm:text-sm hover:bg-white/20 transition-all">
                    Hubungi Pemesanan
                </a>
            </div>
        </div>
    </section>

@endsection

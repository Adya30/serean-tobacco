@extends('layouts.app')

@section('title', 'Kontak & Informasi — Serean Tobacco')
@section('meta_description', 'Informasi resmi kontak, alamat kantor sentra, layanan WhatsApp, dan email Serean Tobacco.')

@section('content')

    <section class="pt-28 sm:pt-36 pb-12 sm:pb-16 border-b border-brand-border bg-gradient-to-b from-brand-surface to-white relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <h1 class="font-serif text-2xl sm:text-3xl lg:text-[32px] font-extrabold text-[#1a0f07] leading-tight tracking-tight">
                Hubungi Serean Tobacco.
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-brand-muted mt-2 leading-relaxed">
                Informasi alamat sentra, layanan konsultasi, dan pemesanan tembakau.
            </p>
        </div>
    </section>

    <section class="py-14 sm:py-20 bg-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4 sm:space-y-5">

                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-start gap-4 group" data-aos="fade-up">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-brand-gold text-xl shrink-0 shadow-sm group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                            Kantor &amp; Gudang Sortir
                        </h2>
                        <p class="text-xs sm:text-sm text-brand-espresso font-medium mt-1 leading-relaxed">
                            Desa Kalisari, Kec. Banyuglugur, Kab. Situbondo, Jawa Timur
                        </p>
                    </div>
                </div>

                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-start gap-4 group" data-aos="fade-up" data-aos-delay="50">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-emerald-600 text-xl shrink-0 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                            Nomor WhatsApp
                        </h2>
                        <p class="text-base sm:text-lg font-bold text-brand-espresso mt-0.5 tracking-tight">
                            0878-5532-0286
                        </p>
                    </div>
                </div>

                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-start gap-4 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-brand-gold text-xl shrink-0 shadow-sm group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                            Email Resmi
                        </h2>
                        <p class="text-xs sm:text-sm font-semibold text-brand-espresso mt-1">
                            info@sereantobacco.co.id
                        </p>
                    </div>
                </div>

                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-start gap-4 group" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-brand-gold text-xl shrink-0 shadow-sm group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                            Jam Operasional Gudang
                        </h2>
                        <p class="text-xs sm:text-sm font-bold text-brand-espresso mt-1">
                            Senin – Sabtu: 08.00 – 17.00 WIB
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16 bg-brand-dark text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <h2 class="font-serif text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                Ingin Mengunjungi Sentra Tembakau Kami di Situbondo?
            </h2>
            <p class="text-xs sm:text-sm text-stone-300 mt-2 max-w-lg mx-auto leading-relaxed">
                Kami dengan senang hati menyambut kedatangan Anda untuk melihat langsung proses sortir dan menguji aroma tembakau pilihan Nusantara.
            </p>
            <div class="mt-6 flex items-center justify-center gap-3">
                <a href="https://wa.me/6287855320286?text=Halo%20Serean%20Tobacco,%20saya%20ingin%20jadwalkan%20kunjungan%20ke%20gudang%20Situbondo" target="_blank" rel="noopener noreferrer" class="px-6 py-3 rounded-full bg-brand-gold text-brand-dark font-bold text-xs hover:bg-amber-400 transition-all shadow-md inline-flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Jadwalkan Kunjungan via WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

@endsection

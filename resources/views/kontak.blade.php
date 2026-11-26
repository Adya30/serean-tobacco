@extends('layouts.app')

@section('title', 'Kontak & Informasi — Serean Tobacco Temanggung')
@section('meta_description', 'Informasi resmi kontak, alamat kantor sentra, layanan WhatsApp, dan email kemitraan Serean Tobacco Temanggung.')

@section('content')

    
    <section class="pt-28 sm:pt-36 pb-12 sm:pb-16 border-b border-brand-border bg-gradient-to-b from-brand-surface to-white relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-xs font-semibold text-brand-gold uppercase mb-2.5 shadow-sm">
                <i class="fa-solid fa-address-book text-xs"></i>
                <span>Direktori Kontak Resmi</span>
            </span>

            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#1a0f07] leading-tight tracking-tight">
                Hubungi Serean Tobacco.
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-brand-muted mt-2 leading-relaxed">
                Informasi lengkap kantor sentra, layanan konsultasi varietas tembakau, dan kemitraan pengadaan partai.
            </p>
        </div>
    </section>

    
    <section class="py-14 sm:py-20 bg-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="space-y-4 sm:space-y-5">

                
                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-5 group" data-aos="fade-up">
                    <div class="flex items-start gap-4">
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
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">
                                Sentra sortir, perajangan halus, dan pengeringan daun tembakau berkualitas pilihan Nusantara.
                            </p>
                        </div>
                    </div>
                    <div class="shrink-0 pt-2 md:pt-0">
                        <a href="https://maps.google.com/?q=Desa+Kalisari,+Banyuglugur,+Situbondo,+Jawa+Timur" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto px-5 py-2.5 rounded-full bg-white hover:bg-brand-espresso hover:text-white text-brand-espresso border border-brand-border font-semibold text-xs transition-all inline-flex items-center justify-center gap-2 shadow-sm group-hover:border-brand-espresso">
                            <i class="fa-solid fa-map-location-dot text-brand-gold"></i>
                            <span>Buka Google Maps</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-1"></i>
                        </a>
                    </div>
                </div>

                
                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-5 group" data-aos="fade-up" data-aos-delay="50">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-emerald-600 text-xl shrink-0 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                                    WhatsApp Resmi &amp; Konsultasi Cepat
                                </h2>
                                <span class="text-[9px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full font-semibold">Online</span>
                            </div>
                            <p class="text-xs text-brand-muted mt-1">
                                Kontak Person: <strong class="text-brand-espresso font-bold">Rajif Fakhri (Feri)</strong>
                            </p>
                            <p class="text-base sm:text-lg font-bold text-brand-espresso mt-0.5 tracking-tight">
                                0878-5532-0286
                            </p>
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">
                                Layanan cepat untuk menanyakan varietas, ketersediaan stok, paket sampel, dan pemesanan. Aktif 08.00 – 21.00 WIB.
                            </p>
                        </div>
                    </div>
                    <div class="shrink-0 pt-2 md:pt-0">
                        <a href="https://wa.me/6287855320286?text=Halo%20Serean%20Tobacco,%20saya%20ingin%20konsultasi%20pemesanan%20tembakau" target="_blank" rel="noopener noreferrer" class="w-full md:w-auto px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition-all inline-flex items-center justify-center gap-2 shadow-sm">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Chat Langsung via WhatsApp</span>
                            <i class="fa-solid fa-paper-plane text-[10px] ml-1"></i>
                        </a>
                    </div>
                </div>

                
                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-5 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-brand-gold text-xl shrink-0 shadow-sm group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                                Email Kemitraan &amp; Pengadaan
                            </h2>
                            <p class="text-xs sm:text-sm font-semibold text-brand-espresso mt-0.5">
                                kemitraan@sereantobacco.co.id
                            </p>
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">
                                Untuk penawaran kontrak suplai rutin pabrik rokok, proposal distributor, dan penawaran hasil panen petani.
                            </p>
                        </div>
                    </div>
                    <div class="shrink-0 pt-2 md:pt-0">
                        <a href="mailto:kemitraan@sereantobacco.co.id?subject=Kerjasama%20Kemitraan%20Tembakau" class="w-full md:w-auto px-5 py-2.5 rounded-full bg-white hover:bg-brand-espresso hover:text-white text-brand-espresso border border-brand-border font-semibold text-xs transition-all inline-flex items-center justify-center gap-2 shadow-sm group-hover:border-brand-espresso">
                            <i class="fa-solid fa-envelope text-brand-gold"></i>
                            <span>Kirim Surat Email</span>
                            <i class="fa-solid fa-arrow-right text-[10px] ml-1"></i>
                        </a>
                    </div>
                </div>

                
                <div class="p-6 sm:p-7 rounded-2xl sm:rounded-3xl bg-brand-surface border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-5 group" data-aos="fade-up" data-aos-delay="150">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-brand-border flex items-center justify-center text-brand-gold text-xl shrink-0 shadow-sm group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <h2 class="font-serif text-lg sm:text-xl font-extrabold text-[#1a0f07] leading-snug">
                                Jam Operasional Gudang
                            </h2>
                            <p class="text-xs sm:text-sm font-bold text-brand-espresso mt-0.5">
                                Senin – Sabtu: 08.00 – 17.00 WIB
                            </p>
                            <p class="text-[11px] sm:text-xs text-brand-muted mt-0.5">
                                Kunjungan langsung untuk cek fisik mutu daun tembakau. Minggu dan hari libur nasional layanan WhatsApp tetap aktif.
                            </p>
                        </div>
                    </div>
                    <div class="shrink-0 pt-2 md:pt-0">
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-white border border-brand-border text-xs font-semibold text-brand-espresso shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Buka Hari Kerja</span>
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    
    <section class="py-12 sm:py-16 bg-brand-dark text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <h2 class="font-serif text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
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

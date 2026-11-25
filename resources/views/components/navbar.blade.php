<header id="site-header" class="fixed top-3 sm:top-4 inset-x-0 z-50 px-3 sm:px-6 pointer-events-none transition-all duration-300">
    <div class="max-w-7xl mx-auto pointer-events-auto">
        <div id="navbar-inner" class="flex items-center justify-between px-5 sm:px-7 h-14 sm:h-16 rounded-2xl sm:rounded-full bg-white/90 backdrop-blur-md border border-brand-border/90 shadow-md sm:shadow-lg shadow-brand-espresso/5 transition-all duration-300">

            <a href="#beranda" class="flex items-center gap-2.5 sm:gap-3 shrink-0 group">
                <img id="navbar-logo" src="{{ asset('logo.png') }}" alt="Logo Serean Tobacco" class="h-8 sm:h-9 w-auto object-contain transition-all duration-300">
                <div class="flex flex-col">
                    <span class="font-serif font-bold text-sm sm:text-base lg:text-lg text-brand-espresso leading-none group-hover:text-brand-gold transition-colors">
                        Serean Tobacco
                    </span>
                    <span class="text-[9px] sm:text-[10px] text-brand-muted tracking-wider uppercase mt-0.5">
                        Temanggung • Nusantara
                    </span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-6 lg:gap-8 text-xs sm:text-sm font-semibold text-brand-muted" aria-label="Navigasi Utama">
                <a href="#beranda" class="hover:text-brand-espresso transition-colors">Beranda</a>
                <a href="#tentang" class="hover:text-brand-espresso transition-colors">Tentang</a>
                <a href="#produk" class="hover:text-brand-espresso transition-colors">Produk</a>
                <a href="#testimoni" class="hover:text-brand-espresso transition-colors">Testimoni</a>
                <a href="#kontak" class="hover:text-brand-espresso transition-colors">Kontak</a>
            </nav>

            <div class="hidden md:flex items-center">
                <button type="button" onclick="openLoginModal()" class="inline-flex items-center gap-1.5 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all duration-200 shadow-sm hover:shadow">
                    <i class="fa-solid fa-arrow-right-to-bracket text-brand-gold text-[11px]"></i>
                    <span>Login</span>
                </button>
            </div>

            <div class="flex items-center gap-2 md:hidden">
                <button type="button" onclick="openLoginModal()" class="px-3.5 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-right-to-bracket text-brand-gold text-xs"></i>
                    <span>Login</span>
                </button>
                <button id="mobile-toggle" type="button" class="p-2 text-brand-espresso text-base rounded-xl border border-brand-border bg-white focus:outline-none" aria-label="Buka Menu">
                    <i id="mobile-icon" class="fa-solid fa-bars"></i>
                </button>
            </div>

        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-2 rounded-2xl border border-brand-border bg-white/95 backdrop-blur-md px-6 py-5 space-y-3 shadow-xl">
            <a href="#beranda" class="mobile-link block text-base font-semibold text-brand-espresso py-2 border-b border-stone-100">
                <i class="fa-solid fa-house-chimney text-brand-gold mr-2.5 text-sm"></i> Beranda
            </a>
            <a href="#tentang" class="mobile-link block text-base font-semibold text-brand-espresso py-2 border-b border-stone-100">
                <i class="fa-solid fa-circle-info text-brand-gold mr-2.5 text-sm"></i> Tentang Kami
            </a>
            <a href="#produk" class="mobile-link block text-base font-semibold text-brand-espresso py-2 border-b border-stone-100">
                <i class="fa-solid fa-box-open text-brand-gold mr-2.5 text-sm"></i> Produk Tembakau
            </a>
            <a href="#testimoni" class="mobile-link block text-base font-semibold text-brand-espresso py-2 border-b border-stone-100">
                <i class="fa-solid fa-comments text-brand-gold mr-2.5 text-sm"></i> Testimoni
            </a>
            <a href="#kontak" class="mobile-link block text-base font-semibold text-brand-espresso py-2">
                <i class="fa-solid fa-envelope text-brand-gold mr-2.5 text-sm"></i> Kontak &amp; Pemesanan
            </a>
        </div>
    </div>
</header>

<script>
    (function () {
        const inner = document.getElementById('navbar-inner');
        if (!inner) return;

        function handleScroll() {
            if (window.scrollY > 30) {
                inner.classList.add('bg-white/95', 'shadow-lg', 'border-brand-border');
                inner.classList.remove('bg-white/90', 'shadow-md');
            } else {
                inner.classList.remove('bg-white/95', 'shadow-lg');
                inner.classList.add('bg-white/90', 'shadow-md');
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    })();
</script>

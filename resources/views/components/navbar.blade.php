<header id="site-header" class="fixed top-3 sm:top-4 inset-x-0 z-50 px-3 sm:px-6 pointer-events-none transition-all duration-300">
    <div class="max-w-7xl mx-auto pointer-events-auto">
        <div id="navbar-inner" class="flex items-center justify-between px-5 sm:px-7 h-14 sm:h-16 rounded-2xl sm:rounded-full bg-white/90 backdrop-blur-md border border-brand-border/90 shadow-md sm:shadow-lg shadow-brand-espresso/5 transition-all duration-300">

            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3 shrink-0 group">
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

            <nav class="hidden md:flex items-center gap-5 lg:gap-7 text-xs sm:text-sm font-semibold text-brand-muted" aria-label="Navigasi Utama">
                <a href="{{ route('home') }}" class="hover:text-brand-espresso transition-colors {{ request()->routeIs('home') ? 'text-brand-espresso font-bold' : '' }}">Beranda</a>
                <a href="{{ route('tentang') }}" class="hover:text-brand-espresso transition-colors {{ request()->routeIs('tentang') ? 'text-brand-gold font-bold' : '' }}">Tentang</a>
                <a href="{{ route('produk') }}" class="hover:text-brand-espresso transition-colors {{ request()->routeIs('produk') ? 'text-brand-gold font-bold' : '' }}">Produk</a>
                <a href="{{ route('kontak') }}" class="hover:text-brand-espresso transition-colors {{ request()->routeIs('kontak') ? 'text-brand-gold font-bold' : '' }}">Kontak</a>
                @auth
                    <a href="{{ route('keranjang') }}" class="hover:text-brand-espresso transition-colors flex items-center gap-1.5 {{ request()->routeIs('keranjang') ? 'text-brand-gold font-bold' : '' }}">
                        <i class="fa-solid fa-cart-shopping text-brand-gold text-xs"></i>
                        <span>Keranjang</span>
                        <span class="w-4 h-4 rounded-full bg-brand-gold text-white text-[9px] font-bold flex items-center justify-center">3</span>
                    </a>
                @endauth
            </nav>

            <div class="hidden md:flex items-center">
                @auth
                    <div class="relative group">
                        <button type="button" class="inline-flex items-center gap-2 px-3.5 py-1.5 sm:py-2 rounded-full bg-brand-surface border border-brand-border text-brand-espresso text-xs font-bold hover:border-brand-gold transition-all shadow-sm">
                            <div class="w-6 h-6 rounded-full bg-brand-espresso text-brand-gold text-[10px] font-serif flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="max-w-[110px] truncate">{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-[9px] text-brand-muted group-hover:rotate-180 transition-transform"></i>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 rounded-2xl bg-white border border-brand-border shadow-xl py-2 hidden group-hover:block transition-all z-50">
                            <div class="px-4 py-2 border-b border-stone-100">
                                <p class="text-xs font-bold text-brand-espresso truncate">{{ Auth::user()->name }}</p>
                                <span class="text-[10px] text-brand-gold uppercase tracking-wider font-semibold">
                                    {{ Auth::user()->isAdmin() ? 'Administrator' : (Auth::user()->isPetani() ? 'Petani' : 'Customer') }}
                                </span>
                            </div>

                            @if (Auth::user()->isAdmin() || Auth::user()->isPetani())
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-brand-espresso hover:bg-stone-50 hover:text-brand-gold transition-colors">
                                    <i class="fa-solid fa-gauge text-brand-gold text-xs"></i>
                                    <span>Panel Dashboard</span>
                                </a>
                            @endif

                            <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-brand-espresso hover:bg-stone-50 hover:text-brand-gold transition-colors">
                                <i class="fa-solid fa-user-gear text-brand-gold text-xs"></i>
                                <span>Profil Saya</span>
                            </a>

                            @if (Auth::user()->isCustomer())
                                <a href="{{ route('customer.transaksi') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-brand-espresso hover:bg-stone-50 hover:text-brand-gold transition-colors">
                                    <i class="fa-solid fa-receipt text-brand-gold text-xs"></i>
                                    <span>Riwayat Pesanan</span>
                                </a>
                            @endif

                            <a href="{{ route('keranjang') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-brand-espresso hover:bg-stone-50 hover:text-brand-gold transition-colors">
                                <i class="fa-solid fa-cart-shopping text-brand-gold text-xs"></i>
                                <span>Keranjang Belanja</span>
                            </a>

                            <div class="border-t border-stone-100 my-1"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors cursor-pointer">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all duration-200 shadow-sm hover:shadow">
                        <span>Login</span>
                    </a>
                @endauth
            </div>

            <div class="flex items-center gap-2 md:hidden">
                @auth
                    <a href="{{ route('profile') }}" class="px-3 py-1.5 rounded-full bg-brand-surface border border-brand-border text-brand-espresso text-xs font-bold inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-user text-brand-gold text-xs"></i>
                        <span>Profil</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold inline-flex items-center gap-1.5">
                        <span>Login</span>
                    </a>
                @endauth
                <button id="mobile-toggle" type="button" class="p-2 text-brand-espresso text-base rounded-xl border border-brand-border bg-white focus:outline-none" aria-label="Buka Menu">
                    <i id="mobile-icon" class="fa-solid fa-bars"></i>
                </button>
            </div>

        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-2 rounded-2xl border border-brand-border bg-white/95 backdrop-blur-md px-6 py-5 space-y-3 shadow-xl">
            <a href="{{ route('home') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('home') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 border-b border-stone-100">
                <i class="fa-solid fa-house-chimney text-brand-gold mr-2.5 text-sm"></i> Beranda
            </a>
            <a href="{{ route('tentang') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('tentang') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 border-b border-stone-100">
                <i class="fa-solid fa-circle-info text-brand-gold mr-2.5 text-sm"></i> Tentang Kami
            </a>
            <a href="{{ route('produk') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('produk') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 border-b border-stone-100">
                <i class="fa-solid fa-box-open text-brand-gold mr-2.5 text-sm"></i> Produk Tembakau
            </a>
            <a href="{{ route('kontak') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('kontak') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 {{ Auth::check() ? 'border-b border-stone-100' : '' }}">
                <i class="fa-solid fa-address-book text-brand-gold mr-2.5 text-sm"></i> Kontak Kami
            </a>
            @auth
                <a href="{{ route('keranjang') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('keranjang') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 border-b border-stone-100">
                    <i class="fa-solid fa-cart-shopping text-brand-gold mr-2.5 text-sm"></i> Keranjang Belanja <span class="ml-2 px-2 py-0.5 rounded-full text-xs bg-brand-gold text-white font-bold">3</span>
                </a>
                @if (Auth::user()->isAdmin() || Auth::user()->isPetani())
                    <a href="{{ route('dashboard') }}" class="mobile-link block text-base font-semibold text-brand-espresso py-2 border-b border-stone-100">
                        <i class="fa-solid fa-gauge text-brand-gold mr-2.5 text-sm"></i> Panel Dashboard
                    </a>
                @endif
                <a href="{{ route('profile') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('profile') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 border-b border-stone-100">
                    <i class="fa-solid fa-user-gear text-brand-gold mr-2.5 text-sm"></i> Profil Saya ({{ Auth::user()->name }})
                </a>
                @if (Auth::user()->isCustomer())
                    <a href="{{ route('customer.transaksi') }}" class="mobile-link block text-base font-semibold {{ request()->routeIs('customer.transaksi*') ? 'text-brand-gold font-bold' : 'text-brand-espresso' }} py-2 border-b border-stone-100">
                        <i class="fa-solid fa-receipt text-brand-gold mr-2.5 text-sm"></i> Riwayat Pesanan
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="pt-2">
                    @csrf
                    <button type="submit" class="w-full text-left text-base font-bold text-red-600 py-2 flex items-center">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2.5 text-sm"></i> Keluar (Logout)
                    </button>
                </form>
            @endauth
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

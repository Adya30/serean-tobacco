<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden w-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="@yield('meta_description', 'Serean Tobacco - Sentra Jasa Pengolahan dan Perdagangan Tembakau Pilihan Nusantara.')">
    <title>@yield('title', 'Serean Tobacco — Jasa & Tembakau Nusantara')</title>

    
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8UXYtfeUzVC01S9LBk64UlsOXgzGYQKREIjTLzdYXRF63oCXBKQg89P00oRd+EQ8fIEg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            espresso: '#3C220F',
                            dark: '#261509',
                            gold: '#B07B27',
                            goldHover: '#98661C',
                            surface: '#FAF8F5',
                            card: '#FFFFFF',
                            border: '#EDE7E1',
                            muted: '#6E6259',
                        }
                    },
                    fontFamily: {
                        serif: ['"Poppins"', 'system-ui', 'sans-serif'],
                        display: ['"Poppins"', 'system-ui', 'sans-serif'],
                        sans: ['"Poppins"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * {
            box-sizing: border-box;
        }
        html, body {
            max-width: 100%;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            background-color: #FAF8F5;
            color: #261509;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .no-scrollbar {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-brand-surface text-brand-dark antialiased overflow-x-hidden min-h-screen flex flex-col relative">

    
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden select-none opacity-[0.03]" aria-hidden="true">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="tobacco-leaf-pattern" width="60" height="60" patternUnits="userSpaceOnUse" patternTransform="rotate(20)">
                    <g transform="translate(10, 6) scale(0.2)" fill="none" stroke="#3C220F" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M50 5 C75 35, 82 85, 50 155 C18 85, 25 35, 50 5 Z" fill="#3C220F" fill-opacity="0.25"></path>
                        <path d="M50 15 L50 150 M50 45 L70 32 M50 70 L75 55 M50 95 L72 80 M50 120 L65 108 M50 45 L30 32 M50 70 L25 55 M50 95 L28 80 M50 120 L35 108"></path>
                    </g>
                    <g transform="translate(40, 36) scale(0.16) rotate(-35 50 80)" fill="none" stroke="#3C220F" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M50 5 C75 35, 82 85, 50 155 C18 85, 25 35, 50 5 Z" fill="#3C220F" fill-opacity="0.25"></path>
                        <path d="M50 15 L50 150 M50 45 L70 32 M50 70 L75 55 M50 95 L72 80 M50 120 L65 108 M50 45 L30 32 M50 70 L25 55 M50 95 L28 80 M50 120 L35 108"></path>
                    </g>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#tobacco-leaf-pattern)" />
        </svg>
    </div>

    
    <x-navbar />

    
    <main class="flex-grow w-full overflow-x-hidden relative z-10">
        @yield('content')
    </main>

    
    <footer class="w-full bg-brand-dark text-stone-300 pt-12 pb-8 border-t border-brand-gold/20 relative z-10 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-8 border-b border-brand-gold/15">

                
                <div class="md:col-span-6 space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.png') }}" alt="Logo Serean Tobacco" class="h-10 w-auto object-contain bg-white rounded-xl p-1">
                        <div class="flex flex-col">
                            <span class="font-serif font-bold text-base sm:text-lg text-white leading-none">
                                Serean Tobacco
                            </span>
                            <span class="text-[10px] text-stone-400 tracking-wider uppercase mt-1">
                                Sentra Tembakau Nusantara
                            </span>
                        </div>
                    </div>

                    <p class="text-stone-300 text-xs sm:text-sm leading-relaxed max-w-lg">
                        Sentra pengolahan dan perdagangan daun tembakau pilihan Nusantara. Menyediakan perajangan presisi, pengeringan teratur, dan hasil panen berkualitas dari sentra Temanggung dan nusantara.
                    </p>
                </div>

                
                <div class="md:col-span-3 space-y-3">
                    <h4 class="font-serif font-bold text-sm sm:text-base text-white">Navigasi</h4>
                    <ul class="space-y-2 text-stone-300 text-xs sm:text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-brand-gold transition-colors">Beranda</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-brand-gold transition-colors">Tentang</a></li>
                        <li><a href="{{ route('produk') }}" class="hover:text-brand-gold transition-colors">Produk</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-brand-gold transition-colors">Kontak</a></li>
                    </ul>
                </div>

                
                <div class="md:col-span-3 space-y-3">
                    <h4 class="font-serif font-bold text-sm sm:text-base text-white">Kantor &amp; Sentra</h4>
                    <div class="space-y-1.5 text-stone-300 text-xs sm:text-sm">
                        <p class="leading-relaxed">Desa Kalisari, Kec. Banyuglugur, Kab. Situbondo, Jawa Timur</p>
                    </div>
                </div>

            </div>

            
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left text-stone-400 text-[11px] sm:text-xs">
                <p>© 2026 Serean Tobacco. Seluruh Hak Cipta Dilindungi.</p>
                <p>Situbondo • Jawa Timur • Indonesia</p>
            </div>

        </div>
    </footer>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 700,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50
                });
            }
        });
    </script>

    
    <script>
        const toggleBtn = document.getElementById('mobile-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileIcon = document.getElementById('mobile-icon');

        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', () => {
                const isClosed = mobileMenu.classList.contains('hidden');
                mobileMenu.classList.toggle('hidden');
                mobileIcon.classList.toggle('fa-bars', !isClosed);
                mobileIcon.classList.toggle('fa-xmark', isClosed);
            });

            document.querySelectorAll('.mobile-link').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    mobileIcon.classList.add('fa-bars');
                    mobileIcon.classList.remove('fa-xmark');
                });
            });
        }

        function openLoginModal() {
            window.location.href = "{{ route('login') }}";
        }
    </script>
    @stack('scripts')
</body>
</html>

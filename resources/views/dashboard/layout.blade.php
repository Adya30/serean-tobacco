<!DOCTYPE html>
<html lang="id" class="h-full bg-stone-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Serean Tobacco</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
                        serif: ['"Lora"', 'Georgia', 'serif'],
                        display: ['"Lora"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full flex overflow-hidden bg-brand-surface text-brand-dark antialiased">

    <aside id="sidebar" class="w-64 bg-brand-dark text-white flex-shrink-0 flex flex-col justify-between transition-all duration-300 z-30 fixed lg:static inset-y-0 left-0 -translate-x-full lg:translate-x-0 shadow-2xl lg:shadow-none">
        <div>
            <div class="h-16 px-6 flex items-center justify-between border-b border-white/10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-9 w-auto bg-white rounded-lg p-0.5">
                    <div>
                        <span class="font-serif font-bold text-base text-white leading-tight block">Serean Tobacco</span>
                        <span class="text-[10px] text-brand-gold uppercase tracking-wider font-semibold">Panel Kemitraan</span>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="lg:hidden text-white/70 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <nav class="px-4 py-4 space-y-1.5 text-xs font-semibold">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                    <span>Ringkasan Dashboard</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold flex items-center justify-center gap-2 transition-all duration-200 shadow-md cursor-pointer tracking-wide">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden">
        <header class="h-16 bg-white border-b border-brand-border flex items-center justify-between px-4 sm:px-8 z-10">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 text-brand-dark hover:bg-stone-100 rounded-lg">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h1 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso">
                    @yield('page_title', 'Dashboard Panel')
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <button type="button" class="w-9 h-9 rounded-full border border-brand-border bg-brand-surface text-brand-muted hover:text-brand-espresso hover:border-brand-gold transition-colors flex items-center justify-center relative cursor-pointer" aria-label="Notifikasi">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-brand-gold"></span>
                    </button>
                </div>

                <div class="h-5 w-[1px] bg-brand-border"></div>

                <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-brand-border bg-brand-surface hover:bg-white hover:border-brand-gold text-brand-espresso text-xs font-bold transition-all shadow-sm">
                    <i class="fa-regular fa-user text-brand-gold text-xs"></i>
                    <span>Profile</span>
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
                @if (session('status'))
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-circle-exclamation text-red-600 text-base"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>
</body>
</html>

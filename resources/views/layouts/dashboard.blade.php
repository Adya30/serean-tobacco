<!DOCTYPE html>
<html lang="id" class="h-full bg-stone-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Serean Tobacco</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
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
                        serif: ['"Poppins"', 'system-ui', 'sans-serif'],
                        display: ['"Poppins"', 'system-ui', 'sans-serif'],
                        sans: ['"Poppins"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none !important; width: 0 !important; height: 0 !important; }
        .no-scrollbar { -ms-overflow-style: none !important; scrollbar-width: none !important; }
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
                        <span class="text-[10px] text-brand-gold uppercase tracking-wider font-semibold">
                            {{ Auth::user()->isPetani() ? 'Sentra Petani' : 'Sentra Tembakau' }}
                        </span>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="lg:hidden text-white/70 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <nav class="px-4 py-4 space-y-1.5 text-xs font-semibold">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>

                @if (Auth::user()->isAdmin())
                    <a href="{{ route('dashboard.stok') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.stok*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        <i class="fa-solid fa-boxes-stacked w-4 text-center"></i>
                        <span>Pencatatan Stok</span>
                    </a>

                    <a href="{{ route('dashboard.katalog') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.katalog*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        <i class="fa-solid fa-layer-group w-4 text-center"></i>
                        <span>Katalog Barang</span>
                    </a>

                    <a href="{{ route('dashboard.transaksi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.transaksi*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        <i class="fa-solid fa-truck-fast w-4 text-center"></i>
                        <span>Transaksi &amp; Distribusi</span>
                    </a>
                @endif

                <a href="{{ route('dashboard.jadwal') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.jadwal*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-calendar-check w-4 text-center"></i>
                    <span>Jadwal Tanam</span>
                </a>

                <a href="{{ route('dashboard.panen') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.panen*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-wheat-awn w-4 text-center"></i>
                    <span>Hasil Panen</span>
                </a>

                <a href="{{ route('dashboard.rekomendasi-tanam') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.rekomendasi-tanam*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-seedling w-4 text-center"></i>
                    <span>Rekomendasi Tanam</span>
                </a>

                @if (Auth::user()->isAdmin())
                    <a href="{{ route('dashboard.petani') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard.petani*') ? 'bg-brand-gold text-white shadow-sm' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                        <i class="fa-solid fa-users-gear w-4 text-center"></i>
                        <span>Kelola Petani</span>
                    </a>
                @endif
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
        <header class="h-16 bg-white border-b border-brand-border flex items-center justify-between px-4 sm:px-8 relative">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 text-brand-dark hover:bg-stone-100 rounded-lg">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h1 class="font-serif font-bold text-lg sm:text-xl text-brand-espresso">
                    @yield('page_title', 'Dashboard Panel')
                </h1>
            </div>

            @php
                $notifSchedules = \App\Models\PlantingSchedule::when(Auth::user()->isPetani(), function ($q) {
                    return $q->where('user_id', Auth::id());
                })->where('phase', '!=', 'selesai')->orderBy('estimated_harvest_date', 'asc')->get();

                $notifItems = [];
                foreach ($notifSchedules as $ns) {
                    $d = $ns->daysToHarvest();
                    if ($d >= 0 && $d <= 14) {
                        $notifItems[] = [
                            'title' => 'Panen ' . $ns->variety . ' Dekat',
                            'desc' => 'Tersisa ' . $d . ' hari lagi menuju panen di ' . $ns->location . '.',
                            'badge' => 'Panen',
                            'badgeColor' => 'bg-amber-100 text-amber-800',
                            'icon' => 'fa-solid fa-hourglass-half text-amber-600',
                        ];
                    } elseif ($ns->phase === 'pemeliharaan') {
                        $notifItems[] = [
                            'title' => 'Fase Pemeliharaan: ' . $ns->variety,
                            'desc' => 'Waktunya pendangiran, pemupukan susulan, dan wiwil pucuk.',
                            'badge' => 'Perawatan',
                            'badgeColor' => 'bg-emerald-100 text-emerald-800',
                            'icon' => 'fa-solid fa-leaf text-emerald-600',
                        ];
                    } elseif ($ns->phase === 'persemaian') {
                        $notifItems[] = [
                            'title' => 'Persemaian Bibit: ' . $ns->variety,
                            'desc' => 'Cek kelembapan naungan dan penyiraman pagi/sore secara rutin.',
                            'badge' => 'Semai',
                            'badgeColor' => 'bg-sky-100 text-sky-800',
                            'icon' => 'fa-solid fa-seedling text-sky-600',
                        ];
                    }
                }
            @endphp

            <div class="flex items-center gap-3">
                <div class="relative">
                    <button id="btnNotif" type="button" onclick="toggleNotifications()" class="relative w-9 h-9 rounded-full text-stone-500 hover:text-stone-800 hover:bg-stone-100 transition-colors flex items-center justify-center cursor-pointer" aria-label="Notifikasi">
                        <i class="fa-regular fa-bell text-lg"></i>
                        @if (count($notifItems) > 0)
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full ring-2 ring-white"></span>
                        @endif
                    </button>

                    <div id="dropdownNotif" class="hidden absolute right-0 mt-3 w-80 sm:w-96 rounded-2xl bg-white border border-brand-border shadow-2xl p-4 z-50 space-y-3">
                        <div class="flex items-center justify-between border-b border-brand-border pb-2.5">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-bell text-brand-gold text-sm"></i>
                                <h3 class="font-serif font-bold text-sm text-brand-espresso">Notifikasi Jadwal Tanam</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-brand-gold border border-brand-gold/30">
                                {{ count($notifItems) }} Pengingat
                            </span>
                        </div>

                        <div class="max-h-72 overflow-y-auto space-y-2.5 no-scrollbar text-xs">
                            @forelse ($notifItems as $ni)
                                <div class="p-3 rounded-xl bg-brand-surface border border-brand-border flex items-start gap-3 hover:border-brand-gold/50 transition-colors">
                                    <div class="w-8 h-8 rounded-lg bg-white border border-brand-border flex items-center justify-center shrink-0 text-sm">
                                        <i class="{{ $ni['icon'] }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-1 mb-0.5">
                                            <h4 class="font-bold text-brand-espresso truncate text-xs">{{ $ni['title'] }}</h4>
                                            <span class="px-1.5 py-0.2 rounded text-[9px] font-bold {{ $ni['badgeColor'] }} shrink-0">
                                                {{ $ni['badge'] }}
                                            </span>
                                        </div>
                                        <p class="text-[11px] text-brand-muted leading-relaxed">{{ $ni['desc'] }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-brand-muted text-xs">
                                    <i class="fa-regular fa-calendar-check text-2xl text-stone-300 block mb-2"></i>
                                    Tidak ada jadwal tanam yang mendesak saat ini.
                                </div>
                            @endforelse
                        </div>

                        <div class="pt-2 border-t border-brand-border">
                            <a href="{{ route('dashboard.jadwal') }}" class="block w-full py-2 text-center rounded-xl bg-brand-surface hover:bg-stone-100 text-brand-espresso text-xs font-bold transition-colors">
                                Lihat Semua Jadwal Tanam &rarr;
                            </a>
                        </div>
                    </div>
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

    @stack('modals')

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function toggleNotifications() {
            const dd = document.getElementById('dropdownNotif');
            dd.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const btn = document.getElementById('btnNotif');
            const dd = document.getElementById('dropdownNotif');
            if (btn && dd && !btn.contains(e.target) && !dd.contains(e.target)) {
                dd.classList.add('hidden');
            }
        });
    </script>
</body>
</html>

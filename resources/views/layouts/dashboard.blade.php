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
                if (session('status')) {
                    $notifItems[] = [
                        'id' => 'sys-status-' . md5(session('status')),
                        'persistent' => false,
                        'title' => 'Informasi Sistem',
                        'desc' => session('status'),
                        'badge' => 'Baru',
                        'badgeColor' => 'bg-emerald-100 text-emerald-800',
                        'icon' => 'fa-solid fa-circle-check text-emerald-600',
                        'url' => null,
                    ];
                }
                if (session('error')) {
                    $notifItems[] = [
                        'id' => 'sys-error-' . md5(session('error')),
                        'persistent' => false,
                        'title' => 'Peringatan',
                        'desc' => session('error'),
                        'badge' => 'Error',
                        'badgeColor' => 'bg-red-100 text-red-800',
                        'icon' => 'fa-solid fa-circle-exclamation text-red-600',
                        'url' => null,
                    ];
                }

                if (Auth::user()->isAdmin()) {
                    $incomingTransactions = \App\Models\Transaction::where('shipping_status', 'menunggu_konfirmasi')
                        ->latest()
                        ->take(10)
                        ->get();

                    foreach ($incomingTransactions as $trx) {
                        $notifItems[] = [
                            'id' => 'trx-in-' . $trx->id,
                            'persistent' => true,
                            'title' => 'Transaksi Masuk: ' . $trx->invoice_code,
                            'desc' => $trx->customer_name . ' memesan ' . number_format($trx->total_weight_kg) . ' Kg (Rp ' . number_format($trx->total_price, 0, ',', '.') . ').',
                            'badge' => 'Transaksi',
                            'badgeColor' => 'bg-sky-100 text-sky-800',
                            'icon' => 'fa-solid fa-truck-fast text-sky-600',
                            'url' => route('dashboard.transaksi'),
                        ];
                    }
                    $incomingHarvests = \App\Models\Harvest::where('status', 'diterima_gudang')
                        ->latest()
                        ->take(10)
                        ->get();

                    foreach ($incomingHarvests as $hv) {
                        $notifItems[] = [
                            'id' => 'harvest-in-' . $hv->id,
                            'persistent' => true,
                            'title' => 'Hasil Panen Masuk: ' . $hv->variety,
                            'desc' => $hv->farmer_name . ' menyetor ' . number_format($hv->harvest_weight_kg) . ' Kg (Grade ' . $hv->grade . ').',
                            'badge' => 'Panen Masuk',
                            'badgeColor' => 'bg-emerald-100 text-emerald-800',
                            'icon' => 'fa-solid fa-wheat-awn text-emerald-600',
                            'url' => route('dashboard.panen'),
                        ];
                    }
                }

                foreach ($notifSchedules as $ns) {
                    $d = $ns->daysToHarvest();
                    if ($d >= 0 && $d <= 14) {
                        $notifItems[] = [
                            'id' => 'sched-harvest-' . $ns->id,
                            'persistent' => true,
                            'title' => 'Panen ' . $ns->variety . ' Dekat',
                            'desc' => 'Tersisa ' . $d . ' hari lagi menuju panen di ' . $ns->location . '.',
                            'badge' => 'Panen',
                            'badgeColor' => 'bg-amber-100 text-amber-800',
                            'icon' => 'fa-solid fa-hourglass-half text-amber-600',
                            'url' => route('dashboard.jadwal'),
                        ];
                    } elseif ($ns->phase === 'pemeliharaan') {
                        $notifItems[] = [
                            'id' => 'sched-care-' . $ns->id,
                            'persistent' => true,
                            'title' => 'Fase Pemeliharaan: ' . $ns->variety,
                            'desc' => 'Waktunya pendangiran, pemupukan susulan, dan wiwil pucuk.',
                            'badge' => 'Perawatan',
                            'badgeColor' => 'bg-emerald-100 text-emerald-800',
                            'icon' => 'fa-solid fa-leaf text-emerald-600',
                            'url' => route('dashboard.jadwal'),
                        ];
                    } elseif ($ns->phase === 'persemaian') {
                        $notifItems[] = [
                            'id' => 'sched-seed-' . $ns->id,
                            'persistent' => true,
                            'title' => 'Persemaian Bibit: ' . $ns->variety,
                            'desc' => 'Cek kelembapan naungan dan penyiraman pagi/sore secara rutin.',
                            'badge' => 'Semai',
                            'badgeColor' => 'bg-sky-100 text-sky-800',
                            'icon' => 'fa-solid fa-seedling text-sky-600',
                            'url' => route('dashboard.jadwal'),
                        ];
                    }
                }
            @endphp

            <div class="flex items-center gap-3">
                <div class="relative">
                    <button id="btnNotif" type="button" onclick="toggleNotifications()" class="relative w-9 h-9 rounded-full text-stone-500 hover:text-stone-800 hover:bg-stone-100 transition-colors flex items-center justify-center cursor-pointer" aria-label="Notifikasi">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span id="notifBadgeCount" class="{{ count($notifItems) > 0 ? 'flex' : 'hidden' }} absolute -top-0.5 -right-0.5 min-w-4 h-4 px-1 bg-red-500 text-white text-[9px] font-bold rounded-full ring-2 ring-white items-center justify-center">
                            {{ count($notifItems) }}
                        </span>
                    </button>

                    <div id="dropdownNotif" class="hidden absolute right-0 mt-3 w-80 sm:w-96 rounded-2xl bg-white border border-brand-border shadow-2xl p-4 z-50 space-y-3">
                        <div class="flex items-center justify-between border-b border-brand-border pb-2.5">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-bell text-brand-gold text-sm"></i>
                                <h3 class="font-serif font-bold text-sm text-brand-espresso">Notifikasi</h3>
                                <span id="notifHeaderCount" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-brand-gold border border-brand-gold/30">
                                    {{ count($notifItems) }}
                                </span>
                            </div>
                            <div id="notifBulkActions" class="{{ count($notifItems) > 0 ? 'flex' : 'hidden' }} items-center gap-2 text-[11px]">
                                <button type="button" onclick="markAllNotifsRead()" class="text-brand-gold hover:underline font-semibold cursor-pointer">Tandai dibaca</button>
                                <span class="text-stone-300">|</span>
                                <button type="button" onclick="clearAllNotifs()" class="text-red-600 hover:underline font-semibold cursor-pointer">Hapus</button>
                            </div>
                        </div>

                        <div id="notifList" class="max-h-72 overflow-y-auto space-y-2.5 no-scrollbar text-xs">
                            @foreach ($notifItems as $ni)
                                <div data-notif-id="{{ $ni['id'] }}" data-notif-persistent="{{ $ni['persistent'] ? '1' : '0' }}" class="notif-item p-3 rounded-xl bg-brand-surface border border-brand-border flex items-start gap-3 hover:border-brand-gold/50 transition-all">
                                    <div class="w-8 h-8 rounded-lg bg-white border border-brand-border flex items-center justify-center shrink-0 text-sm">
                                        <i class="{{ $ni['icon'] }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-1 mb-0.5">
                                            @if (!empty($ni['url']))
                                                <a href="{{ $ni['url'] }}" class="font-bold text-brand-espresso hover:text-brand-gold truncate text-xs transition-colors">{{ $ni['title'] }}</a>
                                            @else
                                                <h4 class="font-bold text-brand-espresso truncate text-xs">{{ $ni['title'] }}</h4>
                                            @endif
                                            <span class="notif-status-badge px-1.5 py-0.2 rounded text-[9px] font-bold {{ $ni['badgeColor'] }} shrink-0">
                                                {{ $ni['badge'] }}
                                            </span>
                                        </div>
                                        <p class="text-[11px] text-brand-muted leading-relaxed">{{ $ni['desc'] }}</p>
                                        <div class="flex items-center justify-end gap-2 mt-2 pt-1.5 border-t border-brand-border/60">
                                            <button type="button" onclick="markNotifRead('{{ $ni['id'] }}')" class="notif-read-btn inline-flex items-center gap-1 text-[10px] font-semibold text-emerald-700 hover:text-emerald-800 cursor-pointer" title="Tandai sudah dibaca">
                                                <i class="fa-solid fa-check"></i>
                                                <span>Dibaca</span>
                                            </button>
                                            <button type="button" onclick="deleteNotif('{{ $ni['id'] }}')" class="inline-flex items-center gap-1 text-[10px] font-semibold text-red-600 hover:text-red-700 cursor-pointer" title="Hapus notifikasi">
                                                <i class="fa-regular fa-trash-can"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div id="notifEmptyState" class="{{ count($notifItems) > 0 ? 'hidden' : '' }} p-6 text-center text-brand-muted text-xs">
                                <i class="fa-regular fa-bell-slash text-2xl text-stone-300 block mb-2"></i>
                                Tidak ada notifikasi saat ini.
                            </div>
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
                    @if (Auth::user()->profilePhotoUrl())
                        <img src="{{ Auth::user()->profilePhotoUrl() }}" alt="{{ Auth::user()->name }}" class="w-5 h-5 rounded-full object-cover border border-brand-border">
                    @else
                        <i class="fa-regular fa-user text-brand-gold text-xs"></i>
                    @endif
                    <span>Profile</span>
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
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

        const notifStorageKeyRead = 'serean_notif_read_{{ Auth::id() }}';
        const notifStorageKeyDeleted = 'serean_notif_deleted_{{ Auth::id() }}';

        function getNotifList(key) {
            try {
                return JSON.parse(localStorage.getItem(key) || '[]');
            } catch (e) {
                return [];
            }
        }

        function saveNotifList(key, list) {
            localStorage.setItem(key, JSON.stringify(list));
        }

        function syncNotifState() {
            const readIds = getNotifList(notifStorageKeyRead);
            const deletedIds = getNotifList(notifStorageKeyDeleted);
            const items = document.querySelectorAll('.notif-item');

            let visibleCount = 0;
            let unreadCount = 0;

            items.forEach(function (el) {
                const id = el.getAttribute('data-notif-id');
                const isPersistent = el.getAttribute('data-notif-persistent') === '1';

                if (el.dataset.deleted === '1' || (isPersistent && deletedIds.includes(id))) {
                    el.classList.add('hidden');
                    return;
                }

                el.classList.remove('hidden');
                visibleCount++;

                const isRead = el.dataset.read === '1' || (isPersistent && readIds.includes(id));
                const readBtn = el.querySelector('.notif-read-btn');

                if (isRead) {
                    el.classList.add('opacity-60', 'bg-white');
                    el.classList.remove('bg-brand-surface');
                    if (readBtn) {
                        readBtn.classList.add('hidden');
                    }
                } else {
                    el.classList.remove('opacity-60', 'bg-white');
                    el.classList.add('bg-brand-surface');
                    if (readBtn) {
                        readBtn.classList.remove('hidden');
                    }
                    unreadCount++;
                }
            });

            const badge = document.getElementById('notifBadgeCount');
            const headerCount = document.getElementById('notifHeaderCount');
            const emptyState = document.getElementById('notifEmptyState');
            const bulkActions = document.getElementById('notifBulkActions');

            if (badge) {
                badge.textContent = unreadCount;
                badge.classList.toggle('hidden', unreadCount === 0);
                badge.classList.toggle('flex', unreadCount > 0);
            }
            if (headerCount) {
                headerCount.textContent = unreadCount;
            }
            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount > 0);
            }
            if (bulkActions) {
                bulkActions.classList.toggle('hidden', visibleCount === 0);
                bulkActions.classList.toggle('flex', visibleCount > 0);
            }
        }

        function markNotifRead(id) {
            const el = document.querySelector('.notif-item[data-notif-id="' + id + '"]');
            if (el) {
                el.dataset.read = '1';
                if (el.getAttribute('data-notif-persistent') === '1') {
                    const list = getNotifList(notifStorageKeyRead);
                    if (!list.includes(id)) {
                        list.push(id);
                        saveNotifList(notifStorageKeyRead, list);
                    }
                }
            }
            syncNotifState();
        }

        function deleteNotif(id) {
            const el = document.querySelector('.notif-item[data-notif-id="' + id + '"]');
            if (el) {
                el.dataset.deleted = '1';
                if (el.getAttribute('data-notif-persistent') === '1') {
                    const list = getNotifList(notifStorageKeyDeleted);
                    if (!list.includes(id)) {
                        list.push(id);
                        saveNotifList(notifStorageKeyDeleted, list);
                    }
                }
            }
            syncNotifState();
        }

        function markAllNotifsRead() {
            const readList = getNotifList(notifStorageKeyRead);
            document.querySelectorAll('.notif-item').forEach(function (el) {
                const id = el.getAttribute('data-notif-id');
                el.dataset.read = '1';
                if (el.getAttribute('data-notif-persistent') === '1' && !readList.includes(id)) {
                    readList.push(id);
                }
            });
            saveNotifList(notifStorageKeyRead, readList);
            syncNotifState();
        }

        function clearAllNotifs() {
            const deletedList = getNotifList(notifStorageKeyDeleted);
            document.querySelectorAll('.notif-item').forEach(function (el) {
                const id = el.getAttribute('data-notif-id');
                el.dataset.deleted = '1';
                if (el.getAttribute('data-notif-persistent') === '1' && !deletedList.includes(id)) {
                    deletedList.push(id);
                }
            });
            saveNotifList(notifStorageKeyDeleted, deletedList);
            syncNotifState();
        }

        document.addEventListener('DOMContentLoaded', syncNotifState);
    </script>
</body>
</html>

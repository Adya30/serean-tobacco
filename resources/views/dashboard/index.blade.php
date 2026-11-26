@extends('dashboard.layout')

@section('title', (Auth::user()->isPetani() ? 'Panel Petani Tembakau' : 'Dashboard Administrator') . ' — Serean Tobacco')
@section('page_title', Auth::user()->isPetani() ? 'Panel Sentra Petani Tembakau' : 'Dashboard Administrator')

@section('content')

    @if (Auth::user()->isPetani())
        <div class="p-6 sm:p-7 rounded-3xl bg-gradient-to-r from-brand-dark via-brand-espresso to-[#2b170c] text-white shadow-sm relative overflow-hidden border border-brand-gold/25">
            <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-gold/20 text-brand-gold border border-brand-gold/30">
                        <i class="fa-solid fa-wheat-awn text-[10px]"></i>
                        <span>Sentra Petani Serean</span>
                    </span>
                    <h2 class="font-serif font-extrabold text-2xl sm:text-3xl text-white tracking-tight">
                        Selamat Datang, {{ Auth::user()->name }}
                    </h2>
                    <p class="text-stone-300 text-xs sm:text-sm">
                        Pantau jadwal musim tanam, laporkan hasil panen, dan periksa panduan budidaya tembakau Anda.
                    </p>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('dashboard.panen') }}" class="px-4 py-2 rounded-xl bg-brand-gold hover:bg-brand-goldHover text-white text-xs font-bold transition-all shadow-md">
                        <i class="fa-solid fa-plus mr-1"></i> Catat Panen
                    </a>
                    <a href="{{ route('dashboard.jadwal') }}" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold transition-all">
                        <i class="fa-solid fa-calendar-check mr-1"></i> Jadwal Tanam
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-brand-muted block font-medium">Akumulasi Panen Disetor</span>
                    <span class="font-serif font-extrabold text-2xl text-emerald-700 mt-1 block">{{ number_format($totalPanenKg) }} Kg</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                    <i class="fa-solid fa-wheat-awn"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-brand-muted block font-medium">Jadwal Tanam Aktif</span>
                    <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ $activeSchedules->count() }} Jadwal</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center text-base">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-brand-muted block font-medium">Total Luas Lahan</span>
                    <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ number_format($totalLuasLahan, 2) }} Ha</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs text-brand-muted block font-medium">Estimasi Target Panen</span>
                    <span class="font-serif font-extrabold text-2xl text-brand-gold mt-1 block">{{ number_format($targetTonaseKg) }} Kg</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-base">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
            </div>
        </div>

        @if (!empty($notifications))
            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm space-y-3">
                <div class="flex items-center justify-between border-b border-brand-border pb-2.5">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-bell text-brand-gold text-sm"></i>
                        <h3 class="font-serif font-bold text-sm text-brand-espresso">Notifikasi &amp; Pengingat Jadwal Tanam</h3>
                    </div>
                    <span class="text-[11px] font-semibold text-brand-muted">Pengingat Berkala</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                    @foreach ($notifications as $n)
                        <div class="p-3.5 rounded-xl {{ $n['type'] === 'warning' ? 'bg-amber-50/80 border-amber-200 text-amber-900' : 'bg-brand-surface border-brand-border text-stone-800' }} border flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-2xs">
                                <i class="{{ $n['type'] === 'warning' ? 'fa-solid fa-hourglass-half text-amber-600' : 'fa-solid fa-seedling text-emerald-600' }} text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-xs">{{ $n['title'] }}</h4>
                                <p class="text-[11px] text-stone-600 mt-0.5 leading-relaxed">{{ $n['message'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-7 bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 space-y-4">
                <div class="flex items-center justify-between border-b border-brand-border pb-3">
                    <div>
                        <h3 class="font-serif font-extrabold text-base text-brand-espresso">Jadwal Tanam Sedang Berjalan</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Pantau tahapan vegetatif hingga panen tembakau.</p>
                    </div>
                    <a href="{{ route('dashboard.jadwal') }}" class="text-xs font-bold text-brand-gold hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($userSchedules->take(4) as $js)
                        <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-between gap-3">
                            <div>
                                <span class="font-serif font-bold text-xs text-brand-espresso block">{{ $js->variety }}</span>
                                <span class="text-[11px] text-brand-muted">{{ $js->location }} • {{ $js->land_area_ha }} Ha</span>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $js->phaseBadge() }} block mb-1">
                                    {{ $js->phaseLabel() }}
                                </span>
                                <span class="text-[10px] text-stone-500 font-medium">Panen: {{ date('d M Y', strtotime($js->estimated_harvest_date)) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-brand-muted">
                            Belum ada jadwal penanaman. Tekan tombol "Jadwal Tanam" untuk mulai mencatat.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="lg:col-span-5 bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 space-y-4">
                <div class="flex items-center justify-between border-b border-brand-border pb-3">
                    <div>
                        <h3 class="font-serif font-extrabold text-base text-brand-espresso">Setoran Panen Terakhir</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Riwayat hasil panen yang telah diserahkan ke gudang.</p>
                    </div>
                    <a href="{{ route('dashboard.panen') }}" class="text-xs font-bold text-brand-gold hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($userHarvests as $uh)
                        <div class="p-3 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-between gap-2">
                            <div>
                                <span class="font-serif font-bold text-xs text-brand-espresso block">{{ $uh->variety }}</span>
                                <span class="text-[10px] text-brand-muted">{{ date('d M Y', strtotime($uh->harvest_date)) }} • Grade {{ $uh->grade }}</span>
                            </div>
                            <span class="font-serif font-bold text-xs text-emerald-700">
                                {{ number_format($uh->harvest_weight_kg) }} Kg
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-brand-muted">
                            Belum ada setoran panen tercatat.
                        </div>
                    @endforelse
                </div>

                <div class="pt-2 border-t border-brand-border">
                    <a href="{{ route('dashboard.rekomendasi-tanam') }}" class="w-full py-2.5 px-4 rounded-xl bg-amber-50 hover:bg-amber-100 text-brand-espresso text-xs font-bold flex items-center justify-center gap-2 transition-colors border border-brand-gold/30">
                        <i class="fa-solid fa-seedling text-brand-gold"></i>
                        <span>Buka Rekomendasi Tanam Tembakau</span>
                    </a>
                </div>
            </div>
        </div>

    @else

        <div class="p-6 sm:p-7 rounded-3xl bg-gradient-to-r from-brand-dark via-brand-espresso to-[#2b170c] text-white shadow-sm relative overflow-hidden border border-brand-gold/20">
            <div class="relative z-10">
                <h2 class="font-serif font-extrabold text-2xl sm:text-3xl text-white tracking-tight">
                    Selamat Datang, {{ Auth::user()->name }}
                </h2>
                <p class="text-stone-300 text-xs sm:text-sm mt-1">
                    Ringkasan operasional stok tembakau, total penjualan, dan prediksi serapan pasar.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 sm:gap-6">
            <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-xs sm:text-sm font-medium text-brand-muted">Total Stok Tembakau</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-brand-espresso mt-1 tracking-tight">
                        {{ number_format($stats['total_stok_kg']) }} <span class="text-sm font-normal text-brand-muted">Kg</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm shrink-0">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-xs sm:text-sm font-medium text-brand-muted">Total Penjualan</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-brand-espresso mt-1 tracking-tight">
                        Rp {{ number_format($stats['total_penjualan'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-lg group-hover:bg-emerald-700 group-hover:text-white transition-colors shadow-sm shrink-0">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-xs sm:text-sm font-medium text-brand-muted">Prediksi Penjualan</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-brand-gold mt-1 tracking-tight">
                        Rp {{ number_format($stats['prediksi_penjualan'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-lg group-hover:bg-brand-gold group-hover:text-white transition-colors shadow-sm shrink-0">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-7 bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                        <div>
                            <h3 class="font-serif font-extrabold text-lg sm:text-xl text-brand-espresso tracking-tight">
                                Top Tembakau Terlaris
                            </h3>
                            <p class="text-xs text-brand-muted mt-0.5">
                                Varietas dengan volume penjualan tertinggi.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3.5 pt-4">
                        @foreach ($topTembakau as $index => $item)
                            <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border hover:border-brand-gold/50 transition-all">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-full {{ $index === 0 ? 'bg-amber-400 text-white font-extrabold shadow' : 'bg-stone-200 text-stone-700 font-bold' }} flex items-center justify-center text-xs shrink-0 font-serif">
                                            #{{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h4 class="font-serif font-bold text-xs sm:text-sm text-brand-espresso">{{ $item['name'] }}</h4>
                                            <p class="text-[11px] text-brand-muted">Grade: {{ $item['grade'] }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span class="font-serif font-bold text-xs sm:text-sm text-brand-espresso block">{{ $item['terjual_kg'] }} Kg</span>
                                        <span class="text-[11px] text-emerald-700 font-semibold">Rp {{ number_format($item['pendapatan'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="mt-2.5">
                                    <div class="flex items-center justify-between text-[10px] text-brand-muted mb-1 font-semibold">
                                        <span>Pangsa: {{ $item['persentase'] }}%</span>
                                        <span class="text-emerald-700">{{ $item['trend'] }}</span>
                                    </div>
                                    <div class="w-full bg-stone-200 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-brand-gold h-1.5 rounded-full" style="width: {{ $item['persentase'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                        <div>
                            <h3 class="font-serif font-extrabold text-lg text-brand-espresso tracking-tight">
                                Daftar Petani
                            </h3>
                            <p class="text-xs text-brand-muted mt-0.5">
                                Petani terdaftar di sentra.
                            </p>
                        </div>
                        <a href="{{ route('dashboard.petani') }}" class="text-xs font-bold text-brand-gold hover:underline">
                            Kelola &rarr;
                        </a>
                    </div>

                    <div class="space-y-3 pt-4">
                        @forelse ($petanis->take(4) as $p)
                            <div class="p-3 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-between">
                                <div>
                                    <span class="font-bold text-xs text-brand-espresso block">{{ $p->name }}</span>
                                    <span class="text-[11px] text-brand-muted">{{ $p->farm_location ?? 'Situbondo, Jatim' }}</span>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-brand-gold border border-brand-gold/30">
                                    Aktif
                                </span>
                            </div>
                        @empty
                            <div class="py-8 text-center text-xs text-brand-muted">
                                Belum ada petani terdaftar.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection

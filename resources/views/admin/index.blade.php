@extends('layouts.dashboard')

@section('title', 'Dashboard Administrator — Serean Tobacco')
@section('page_title', 'Dashboard Administrator')

@section('content')

    <div class="p-5 sm:p-6 rounded-3xl bg-gradient-to-r from-brand-dark via-brand-espresso to-[#2b170c] text-white shadow-sm relative overflow-hidden border border-brand-gold/20">
        <div class="relative z-10">
            <h2 class="font-serif font-bold text-lg sm:text-xl text-white tracking-tight">
                Selamat Datang, {{ Auth::user()->name }}
            </h2>
            <p class="text-stone-300 text-xs mt-1">
                Ringkasan operasional stok tembakau, total penjualan, dan prediksi serapan pasar.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
        <div class="p-5 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs font-medium text-brand-muted">Total Stok Tembakau</p>
                <p class="text-lg sm:text-xl font-extrabold text-brand-espresso mt-1 tracking-tight">
                    {{ number_format($stats['total_stok_kg']) }} <span class="text-xs font-normal text-brand-muted">Kg</span>
                </p>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-base group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm shrink-0">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="p-5 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs font-medium text-brand-muted">Total Penjualan</p>
                <p class="text-lg sm:text-xl font-extrabold text-brand-espresso mt-1 tracking-tight">
                    Rp {{ number_format($stats['total_penjualan'], 0, ',', '.') }}
                </p>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-base group-hover:bg-emerald-700 group-hover:text-white transition-colors shadow-sm shrink-0">
                <i class="fa-solid fa-money-bill-trend-up"></i>
            </div>
        </div>

        <div class="p-5 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs font-medium text-brand-muted">Prediksi Penjualan</p>
                <p class="text-lg sm:text-xl font-extrabold text-brand-gold mt-1 tracking-tight">
                    Rp {{ number_format($stats['prediksi_penjualan'], 0, ',', '.') }}
                </p>
            </div>
            <div class="w-11 h-11 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-base group-hover:bg-brand-gold group-hover:text-white transition-colors shadow-sm shrink-0">
                <i class="fa-solid fa-chart-line"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-7 bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-bold text-base sm:text-lg text-brand-espresso tracking-tight">
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
                        <h3 class="font-serif font-bold text-base sm:text-lg text-brand-espresso tracking-tight">
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

@endsection

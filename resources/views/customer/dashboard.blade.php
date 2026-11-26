@extends('layouts.app')

@section('title', 'Dashboard Pelanggan — Serean Tobacco')

@section('content')
    <div class="pt-28 pb-16 min-h-[85vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-brand-dark via-brand-espresso to-[#2b170c] text-white shadow-md relative overflow-hidden border border-brand-gold/20">
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-gold/20 text-brand-gold border border-brand-gold/30 mb-2">
                        Akun Pelanggan Resmi Serean
                    </span>
                    <h1 class="font-serif font-extrabold text-2xl sm:text-3xl text-white tracking-tight">
                        Halo, {{ $user->name }}
                    </h1>
                    <p class="text-stone-300 text-xs sm:text-sm mt-1 leading-relaxed">
                        Pantau riwayat transaksi pembelian tembakau, lacak status pengantaran armada, dan kelola pemesanan langsung ke sentra.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs text-brand-muted block font-medium">Total Pembelian</span>
                        <span class="font-serif font-extrabold text-xl sm:text-2xl text-brand-espresso mt-1 block">
                            Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs text-brand-muted block font-medium">Total Tonase Dipesan</span>
                        <span class="font-serif font-extrabold text-xl sm:text-2xl text-emerald-700 mt-1 block">
                            {{ number_format($totalTonaseKg) }} Kg
                        </span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                        <i class="fa-solid fa-weight-hanging"></i>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs text-brand-muted block font-medium">Pesanan Berjalan</span>
                        <span class="font-serif font-extrabold text-xl sm:text-2xl text-brand-gold mt-1 block">
                            {{ $activeOrders }} Pesanan
                        </span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
                <div class="p-5 sm:p-7 border-b border-brand-border flex items-center justify-between">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">
                            Riwayat Transaksi Pembelian Terbaru
                        </h3>
                        <p class="text-xs text-brand-muted mt-0.5">
                            Daftar pesanan tembakau rajangan beserta alokasi armada pengantaran otomatis.
                        </p>
                    </div>

                    <a href="{{ route('customer.transaksi') }}" class="text-xs font-bold text-brand-gold hover:underline">
                        Lihat Semua Riwayat
                    </a>
                </div>

                <div class="block sm:hidden divide-y divide-brand-border">
                    @forelse ($transactions as $trx)
                        <div class="p-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <span class="font-mono font-bold text-xs text-brand-gold block">{{ $trx->invoice_code }}</span>
                                    <span class="text-[10px] text-brand-muted">{{ date('d M Y', strtotime($trx->created_at)) }}</span>
                                </div>
                                @php
                                    $badgeClass = match($trx->shipping_status) {
                                        'terkirim' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'dalam_pengiriman' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'diproses' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                                        default => 'bg-stone-100 text-stone-700 border-stone-200'
                                    };
                                    $statusLabel = match($trx->shipping_status) {
                                        'terkirim' => 'Terkirim',
                                        'dalam_pengiriman' => 'Dalam Pengiriman',
                                        'diproses' => 'Diproses Gudang',
                                        'dibatalkan' => 'Dibatalkan',
                                        default => 'Menunggu Konfirmasi'
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeClass }} shrink-0">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <div class="text-xs space-y-1 bg-brand-surface p-2.5 rounded-xl border border-brand-border/60">
                                @foreach ($trx->items as $item)
                                    <div class="flex items-center justify-between text-[11px]">
                                        <span class="font-bold text-brand-espresso">{{ $item->product_name }}</span>
                                        <span class="text-brand-muted">{{ $item->quantity_kg }} Kg</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs pt-1 border-t border-brand-border/60">
                                <div>
                                    <span class="text-[10px] text-brand-muted block">Armada</span>
                                    @if ($trx->fleet_type === 'tambahan_armada')
                                        <span class="font-bold text-[11px] text-emerald-800">Truk Kargo</span>
                                    @else
                                        <span class="font-bold text-[11px] text-amber-800">Pick Up</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-[10px] text-brand-muted block">Total Biaya</span>
                                    <span class="font-serif font-bold text-sm text-brand-espresso">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-end pt-2 border-t border-brand-border/60 text-xs">
                                <a href="{{ route('customer.transaksi.show', $trx->id) }}" class="px-3.5 py-1.5 rounded-full bg-brand-espresso text-white text-xs font-bold hover:bg-brand-dark transition-all inline-flex items-center gap-1 shadow-sm">
                                    <span>Lacak Pesanan</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-brand-muted text-xs">
                            Anda belum memiliki riwayat transaksi pembelian.
                        </div>
                    @endforelse
                </div>

                <div class="hidden sm:block overflow-x-auto no-scrollbar">
                    <table class="w-full text-left text-xs min-w-[700px]">
                        <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                            <tr>
                                <th class="py-3.5 px-5 sm:px-6">Invoice</th>
                                <th class="py-3.5 px-5 sm:px-6">Detail Varietas</th>
                                <th class="py-3.5 px-5 sm:px-6 text-center">Tonase (Kg)</th>
                                <th class="py-3.5 px-5 sm:px-6">Armada Pengantaran</th>
                                <th class="py-3.5 px-5 sm:px-6 text-right">Total Biaya</th>
                                <th class="py-3.5 px-5 sm:px-6 text-center">Status</th>
                                <th class="py-3.5 px-5 sm:px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-brand-border">
                            @forelse ($transactions as $trx)
                                <tr class="hover:bg-brand-surface/60 transition-colors">
                                    <td class="py-4 px-5 sm:px-6">
                                        <span class="font-mono font-bold text-xs text-brand-gold block">{{ $trx->invoice_code }}</span>
                                        <span class="text-[10px] text-brand-muted">{{ date('d M Y', strtotime($trx->created_at)) }}</span>
                                    </td>
                                    <td class="py-4 px-5 sm:px-6">
                                        @foreach ($trx->items as $item)
                                            <span class="font-bold text-brand-espresso block text-xs">{{ $item->product_name }}</span>
                                            <span class="text-[11px] text-brand-muted">{{ $item->quantity_kg }} Kg @ Rp {{ number_format($item->price_per_kg) }}</span>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-5 sm:px-6 text-center font-serif font-bold text-sm text-brand-espresso">
                                        {{ number_format($trx->total_weight_kg) }} Kg
                                    </td>
                                    <td class="py-4 px-5 sm:px-6">
                                        @if ($trx->fleet_type === 'tambahan_armada')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-300">
                                                <i class="fa-solid fa-truck-moving text-emerald-600"></i>
                                                <span>Tambahan Armada (&ge;300 Kg)</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-300">
                                                <i class="fa-solid fa-truck-pickup text-amber-600"></i>
                                                <span>Armada Pick Up (&lt;300 Kg)</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-5 sm:px-6 text-right font-serif font-bold text-brand-espresso">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-5 sm:px-6 text-center">
                                        @php
                                            $badgeClass = match($trx->shipping_status) {
                                                'terkirim' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                'dalam_pengiriman' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'diproses' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                'dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                                                default => 'bg-stone-100 text-stone-700 border-stone-200'
                                            };
                                            $statusLabel = match($trx->shipping_status) {
                                                'terkirim' => 'Terkirim',
                                                'dalam_pengiriman' => 'Dalam Pengiriman',
                                                'diproses' => 'Diproses Gudang',
                                                'dibatalkan' => 'Dibatalkan',
                                                default => 'Menunggu Konfirmasi'
                                            };
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-5 sm:px-6 text-center">
                                        <a href="{{ route('customer.transaksi.show', $trx->id) }}" class="px-3 py-1.5 rounded-full bg-brand-surface border border-brand-border hover:border-brand-gold text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1">
                                            <span>Lacak</span>
                                            <i class="fa-solid fa-arrow-right text-[10px] text-brand-gold"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-brand-muted text-xs">
                                        Anda belum memiliki riwayat transaksi pembelian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-between p-6 rounded-3xl bg-amber-50 border border-brand-gold/30">
                <div>
                    <h4 class="font-serif font-bold text-base text-brand-espresso">Butuh Pasokan Tembakau Tambahan?</h4>
                    <p class="text-xs text-brand-muted mt-0.5">Pesan varietas rajangan halus lainnya langsung dari katalog sentra.</p>
                </div>
                <a href="{{ route('produk') }}" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all shadow-sm">
                    Buka Katalog Barang
                </a>
            </div>

        </div>
    </div>
@endsection

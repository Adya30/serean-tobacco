@extends('layouts.app')

@section('title', 'Riwayat Transaksi Saya — Serean Tobacco')

@section('content')
    <div class="pt-28 pb-16 min-h-[85vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <a href="{{ route('customer.dashboard') }}" class="text-xs font-bold text-brand-gold hover:underline inline-flex items-center gap-1.5 mb-1.5">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                    <h1 class="font-serif font-extrabold text-2xl sm:text-3xl text-brand-espresso tracking-tight">
                        Daftar Riwayat Transaksi &amp; Pengiriman
                    </h1>
                    <p class="text-xs sm:text-sm text-brand-muted mt-1">
                        Informasi lengkap pembelian tembakau, invoice resmi, dan armada pengantaran yang ditugaskan.
                    </p>
                </div>

                <a href="{{ route('produk') }}" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all inline-flex items-center gap-2 shadow-sm shrink-0">
                    <i class="fa-solid fa-cart-shopping text-brand-gold text-xs"></i>
                    <span>Beli Tembakau Baru</span>
                </a>
            </div>

            <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
                <div class="block sm:hidden divide-y divide-brand-border">
                    @forelse ($transactions as $trx)
                        <div class="p-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <span class="font-mono font-bold text-xs text-brand-gold block">{{ $trx->invoice_code }}</span>
                                    <span class="text-[10px] text-brand-muted">{{ date('d M Y, H:i', strtotime($trx->created_at)) }}</span>
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
                                    <span class="text-[10px] text-brand-muted block">Rekomendasi Armada</span>
                                    @if ($trx->fleet_type === 'tambahan_armada')
                                        <span class="font-bold text-[11px] text-emerald-800">Truk Kargo</span>
                                    @else
                                        <span class="font-bold text-[11px] text-amber-800">Pick Up</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-[10px] text-brand-muted block">Total Tagihan</span>
                                    <span class="font-serif font-bold text-sm text-brand-espresso">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-brand-border/60 text-xs">
                                <span class="text-[10px] uppercase font-bold {{ $trx->payment_status === 'lunas' ? 'text-emerald-700' : 'text-amber-600' }}">
                                    {{ $trx->payment_status === 'lunas' ? 'Lunas' : 'Menunggu Bayar' }}
                                </span>
                                <a href="{{ route('customer.transaksi.show', $trx->id) }}" class="px-3.5 py-1.5 rounded-full bg-brand-espresso text-white text-xs font-bold hover:bg-brand-dark transition-all inline-flex items-center gap-1 shadow-sm">
                                    <span>Detail &amp; Lacak</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-brand-muted text-xs">
                            Belum ada riwayat transaksi pembelian.
                        </div>
                    @endforelse
                </div>

                <div class="hidden sm:block overflow-x-auto no-scrollbar">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                            <tr>
                                <th class="py-3 px-4 whitespace-nowrap">Invoice</th>
                                <th class="py-3 px-4">Pesanan</th>
                                <th class="py-3 px-4 text-right whitespace-nowrap">Total Tagihan</th>
                                <th class="py-3 px-4 text-center whitespace-nowrap">Status</th>
                                <th class="py-3 px-4 text-center whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-brand-border">
                            @forelse ($transactions as $trx)
                                <tr class="hover:bg-brand-surface/60 transition-colors">
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="font-mono font-bold text-xs text-brand-gold block">{{ $trx->invoice_code }}</span>
                                        <span class="text-[10px] text-brand-muted block">{{ date('d M Y, H:i', strtotime($trx->created_at)) }}</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @foreach ($trx->items as $item)
                                            <div class="text-xs">
                                                <strong class="text-brand-espresso">{{ $item->product_name }}</strong>
                                                <span class="text-brand-muted">({{ $item->quantity_kg }} Kg)</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="py-3.5 px-4 text-right font-serif font-bold text-brand-espresso whitespace-nowrap">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                        <span class="block text-[10px] font-normal uppercase {{ $trx->payment_status === 'lunas' ? 'text-emerald-700 font-bold' : 'text-amber-600' }}">
                                            {{ $trx->payment_status === 'lunas' ? 'Lunas' : 'Menunggu Bayar' }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
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
                                        <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold border whitespace-nowrap {{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        <a href="{{ route('customer.transaksi.show', $trx->id) }}" class="px-3.5 py-1.5 rounded-full bg-brand-espresso text-white text-xs font-bold hover:bg-brand-dark transition-all inline-flex items-center gap-1 shadow-sm whitespace-nowrap">
                                            <span>Detail</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-brand-muted text-xs">
                                        Belum ada riwayat transaksi pembelian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

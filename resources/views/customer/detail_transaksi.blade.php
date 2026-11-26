@extends('layouts.app')

@section('title', 'Detail Transaksi ' . $transaction->invoice_code . ' — Serean Tobacco')

@section('content')
    <div class="pt-28 pb-16 min-h-[85vh]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <a href="{{ route('customer.transaksi') }}" class="text-xs font-bold text-brand-gold hover:underline inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Riwayat Transaksi</span>
                </a>

                <div class="flex items-center gap-2">
                    @if ($transaction->shipping_status === 'menunggu_konfirmasi')
                        <button onclick="document.getElementById('modalUbahAlamat').classList.remove('hidden')" class="px-3.5 py-1.5 rounded-full border border-brand-border hover:border-brand-gold text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1.5 bg-white cursor-pointer shadow-sm">
                            <i class="fa-regular fa-pen-to-square text-[11px] text-brand-gold"></i>
                            <span>Ubah Alamat Pengiriman</span>
                        </button>

                        <form action="{{ route('customer.transaksi.cancel', $transaction->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-3.5 py-1.5 rounded-full border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-bold transition-all cursor-pointer shadow-sm">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="p-6 sm:p-8 rounded-3xl bg-white border border-brand-border shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-brand-border gap-4">
                    <div>
                        <span class="text-xs text-brand-muted block uppercase tracking-wider">Faktur Pembelian Sentra</span>
                        <h1 class="font-mono font-extrabold text-2xl text-brand-espresso mt-0.5">{{ $transaction->invoice_code }}</h1>
                        <p class="text-xs text-brand-muted mt-1">Dibuat pada {{ date('d F Y, H:i', strtotime($transaction->created_at)) }} WIB</p>
                    </div>

                    <div class="sm:text-right">
                        @if ($transaction->fleet_type === 'tambahan_armada')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-300 shadow-sm">
                                <i class="fa-solid fa-truck-moving text-emerald-600"></i>
                                <span>Tambahan Armada Truk (&ge;300 Kg)</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-300 shadow-sm">
                                <i class="fa-solid fa-truck-pickup text-amber-600"></i>
                                <span>Armada Standar Pick Up (&lt;300 Kg)</span>
                            </span>
                        @endif
                        <span class="block text-xs text-stone-500 mt-1 font-mono">No. Resi: <strong>{{ $transaction->tracking_number ?? 'Menunggu Alokasi' }}</strong></span>
                    </div>
                </div>

                <div class="py-6 border-b border-brand-border">
                    <h3 class="font-serif font-bold text-base text-brand-espresso mb-4">Pelacakan Status Pengantaran</h3>

                    @php
                        $step = match($transaction->shipping_status) {
                            'terkirim' => 4,
                            'dalam_pengiriman' => 3,
                            'diproses' => 2,
                            'dibatalkan' => 0,
                            default => 1
                        };
                    @endphp

                    @if ($step === 0)
                        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs flex items-center gap-2">
                            <i class="fa-solid fa-circle-xmark text-red-600 text-base"></i>
                            <span>Pesanan ini telah dibatalkan.</span>
                        </div>
                    @else
                        <div class="grid grid-cols-4 gap-2 text-center text-xs">
                            <div class="space-y-2">
                                <div class="w-8 h-8 rounded-full {{ $step >= 1 ? 'bg-emerald-600 text-white' : 'bg-stone-200 text-stone-500' }} mx-auto flex items-center justify-center font-bold">
                                    <i class="fa-solid fa-check text-xs"></i>
                                </div>
                                <span class="font-bold text-brand-espresso block text-[11px]">Dikonfirmasi</span>
                            </div>

                            <div class="space-y-2">
                                <div class="w-8 h-8 rounded-full {{ $step >= 2 ? 'bg-emerald-600 text-white' : 'bg-stone-200 text-stone-500' }} mx-auto flex items-center justify-center font-bold">
                                    <i class="fa-solid fa-boxes-packing text-xs"></i>
                                </div>
                                <span class="font-bold text-brand-espresso block text-[11px]">Diproses Gudang</span>
                            </div>

                            <div class="space-y-2">
                                <div class="w-8 h-8 rounded-full {{ $step >= 3 ? 'bg-emerald-600 text-white' : 'bg-stone-200 text-stone-500' }} mx-auto flex items-center justify-center font-bold">
                                    <i class="fa-solid fa-truck text-xs"></i>
                                </div>
                                <span class="font-bold text-brand-espresso block text-[11px]">Dalam Pengiriman</span>
                            </div>

                            <div class="space-y-2">
                                <div class="w-8 h-8 rounded-full {{ $step >= 4 ? 'bg-emerald-600 text-white' : 'bg-stone-200 text-stone-500' }} mx-auto flex items-center justify-center font-bold">
                                    <i class="fa-solid fa-house-chimney-check text-xs"></i>
                                </div>
                                <span class="font-bold text-brand-espresso block text-[11px]">Sampai Tujuan</span>
                            </div>
                        </div>

                        <div class="mt-4 p-4 rounded-2xl bg-brand-surface border border-brand-border text-xs">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-location-dot text-brand-gold text-base mt-0.5"></i>
                                <div>
                                    <strong class="text-brand-espresso">Catatan Pelacakan Pengiriman:</strong>
                                    <p class="text-brand-muted mt-0.5 leading-relaxed">
                                        {{ $transaction->tracking_notes ?? 'Pesanan Anda sedang dipersiapkan oleh tim logistik gudang sentra.' }}
                                    </p>
                                    @if ($transaction->estimated_delivery)
                                        <span class="inline-block mt-1 font-semibold text-brand-gold">Estimasi Tiba: {{ $transaction->estimated_delivery }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="py-6 border-b border-brand-border">
                    <h3 class="font-serif font-bold text-base text-brand-espresso mb-3">Item Pembelian Tembakau</h3>
                    <div class="divide-y divide-brand-border">
                        @foreach ($transaction->items as $item)
                            <div class="py-3 flex items-center justify-between text-xs">
                                <div>
                                    <h4 class="font-bold text-sm text-brand-espresso">{{ $item->product_name }}</h4>
                                    <p class="text-brand-muted mt-0.5">{{ $item->variety }} • Grade: {{ $item->grade ?? 'CW' }}</p>
                                    <span class="text-brand-gold font-semibold">{{ $item->quantity_kg }} Kg &times; Rp {{ number_format($item->price_per_kg) }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="font-serif font-bold text-sm text-brand-espresso">Rp {{ number_format($item->subtotal) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                    <div>
                        <h4 class="font-bold text-brand-espresso uppercase tracking-wider text-[11px] mb-2">Tujuan Pengiriman</h4>
                        <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border space-y-1">
                            <strong class="text-brand-espresso block">{{ $transaction->customer_name }}</strong>
                            <span class="text-brand-muted block text-[11px]">{{ $transaction->customer_phone }}</span>
                            <p class="text-brand-espresso font-medium mt-1 leading-relaxed">{{ $transaction->customer_address }}</p>
                            <p class="text-brand-muted text-[11px]">
                                {{ $transaction->desa ? 'Desa ' . $transaction->desa . ', ' : '' }}
                                {{ $transaction->kecamatan ? 'Kec. ' . $transaction->kecamatan . ', ' : '' }}
                                {{ $transaction->kabupaten ? 'Kab/Kota ' . $transaction->kabupaten : '' }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-brand-espresso uppercase tracking-wider text-[11px] mb-2">Rincian Pembayaran</h4>
                        <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border space-y-2">
                            <div class="flex justify-between">
                                <span class="text-brand-muted">Total Berat (Tonase):</span>
                                <strong class="text-brand-espresso">{{ number_format($transaction->total_weight_kg) }} Kg</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-brand-muted">Armada Logistik:</span>
                                <strong class="text-brand-espresso">{{ $transaction->fleet_name }}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-brand-muted">Subtotal Belanja:</span>
                                <span class="font-bold text-brand-espresso">Rp {{ number_format($transaction->items_subtotal > 0 ? $transaction->items_subtotal : ($transaction->total_price - $transaction->shipping_cost), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-brand-muted">Ongkos Kirim Armada:</span>
                                @if ($transaction->fleet_type === 'pick_up')
                                    <span class="font-bold text-amber-800">
                                        Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }} (10%)
                                    </span>
                                @else
                                    <span class="font-bold text-emerald-700">
                                        Rp 0 (Bebas Ongkir Kargo)
                                    </span>
                                @endif
                            </div>
                            <div class="flex justify-between pt-2 border-t border-brand-border">
                                <span class="text-brand-muted font-bold">Total Pembayaran:</span>
                                <strong class="font-serif font-bold text-base text-brand-gold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if ($transaction->shipping_status === 'menunggu_konfirmasi')
        <div id="modalUbahAlamat" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <h3 class="font-serif font-bold text-lg text-brand-espresso">Ubah Alamat &amp; Armada Pengiriman</h3>
                    <button type="button" onclick="document.getElementById('modalUbahAlamat').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form action="{{ route('customer.transaksi.update', $transaction->id) }}" method="POST" class="space-y-3.5 pt-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Nama Penerima</label>
                            <input type="text" name="customer_name" value="{{ $transaction->customer_name }}" required class="w-full px-3 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>

                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Nomor WhatsApp Penerima</label>
                            <input type="tel" name="customer_phone" value="{{ $transaction->customer_phone }}" required class="w-full px-3 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kabupaten/Kota</label>
                            <input type="text" name="kabupaten" value="{{ $transaction->kabupaten }}" required placeholder="cth: Situbondo" class="w-full px-2.5 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kecamatan</label>
                            <input type="text" name="kecamatan" value="{{ $transaction->kecamatan }}" required placeholder="cth: Panji" class="w-full px-2.5 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Desa/Kelurahan</label>
                            <input type="text" name="desa" value="{{ $transaction->desa }}" required placeholder="cth: Curah Jeru" class="w-full px-2.5 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Detail Alamat / Jalan / RT RW</label>
                        <textarea name="customer_address" rows="2" required class="w-full px-3 py-2 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">{{ $transaction->customer_address }}</textarea>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1.5">Pilihan Armada Pengantaran</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-brand-border bg-brand-surface hover:bg-stone-50 cursor-pointer has-[:checked]:border-brand-gold has-[:checked]:bg-amber-50/50">
                                <input type="radio" name="fleet_type" value="pick_up" {{ $transaction->fleet_type === 'pick_up' ? 'checked' : '' }} class="text-brand-espresso">
                                <div>
                                    <strong class="text-brand-espresso block text-[11px]">Pick Up (Ongkir 10%)</strong>
                                    <span class="text-stone-500 text-[10px]">&lt;300 Kg armada standar</span>
                                </div>
                            </label>

                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-brand-border bg-brand-surface hover:bg-stone-50 cursor-pointer has-[:checked]:border-brand-gold has-[:checked]:bg-emerald-50/50">
                                <input type="radio" name="fleet_type" value="tambahan_armada" {{ $transaction->fleet_type === 'tambahan_armada' ? 'checked' : '' }} class="text-brand-espresso">
                                <div>
                                    <strong class="text-brand-espresso block text-[11px]">Truk Kargo (Bebas Ongkir)</strong>
                                    <span class="text-stone-500 text-[10px]">&ge;300 Kg tambahan armada</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-2">
                        <button type="button" onclick="document.getElementById('modalUbahAlamat').classList.add('hidden')" class="px-4 py-2 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 cursor-pointer font-semibold">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

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
                                <span>Armada Truk Kargo</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-300 shadow-sm">
                                <i class="fa-solid fa-truck-pickup text-amber-600"></i>
                                <span>Armada Pick Up</span>
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
                        <div class="relative flex items-start justify-between text-center text-xs">
                            @php
                                $steps = [
                                    ['num' => 1, 'label' => 'Dikonfirmasi', 'icon' => 'fa-check'],
                                    ['num' => 2, 'label' => 'Diproses Gudang', 'icon' => 'fa-boxes-packing'],
                                    ['num' => 3, 'label' => 'Dalam Pengiriman', 'icon' => 'fa-truck'],
                                    ['num' => 4, 'label' => 'Sampai Tujuan', 'icon' => 'fa-house-chimney-check'],
                                ];
                            @endphp

                            @foreach ($steps as $idx => $st)
                                <div class="relative flex-1 flex flex-col items-center">
                                    @if ($idx < count($steps) - 1)
                                        <div class="absolute top-4 left-1/2 w-full h-0.5 {{ $step > $st['num'] ? 'bg-emerald-600' : 'bg-stone-200' }}"></div>
                                    @endif
                                    <div class="relative z-10 w-8 h-8 rounded-full {{ $step >= $st['num'] ? 'bg-emerald-600 text-white' : 'bg-stone-200 text-stone-500' }} flex items-center justify-center font-bold shadow-xs">
                                        <i class="fa-solid {{ $st['icon'] }} text-xs"></i>
                                    </div>
                                    <span class="font-bold text-brand-espresso block text-[11px] mt-2 px-1">{{ $st['label'] }}</span>
                                </div>
                            @endforeach
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
                        <div class="p-4 sm:p-5 rounded-2xl bg-brand-surface border border-brand-border space-y-2.5">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-brand-muted">Total Berat (Tonase)</span>
                                <strong class="text-brand-espresso whitespace-nowrap">{{ number_format($transaction->total_weight_kg) }} Kg</strong>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-brand-muted">Subtotal Belanja</span>
                                <span class="font-bold text-brand-espresso whitespace-nowrap">Rp {{ number_format($transaction->items_subtotal > 0 ? $transaction->items_subtotal : ($transaction->total_price - $transaction->shipping_cost), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-brand-muted">Ongkos Kirim</span>
                                @if ($transaction->shipping_cost > 0)
                                    <span class="font-bold text-amber-800 whitespace-nowrap">
                                        Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="font-bold text-emerald-700 whitespace-nowrap">
                                        Rp 0 (Gratis Ongkir)
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between gap-4 pt-2.5 border-t border-brand-border">
                                <span class="text-brand-espresso font-bold">Total Pembayaran</span>
                                <strong class="font-serif font-extrabold text-base text-brand-gold whitespace-nowrap">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
                            </div>

                            @if ($transaction->shipping_status !== 'dibatalkan' && $transaction->payment_status !== 'lunas')
                                <div class="pt-2">
                                    <button type="button" onclick="document.getElementById('modalPembayaran').classList.remove('hidden')" class="w-full py-2.5 px-4 rounded-xl bg-brand-espresso hover:bg-brand-dark text-white font-bold text-xs transition-all inline-flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                                        <i class="fa-solid fa-credit-card text-brand-gold"></i>
                                        <span>Lakukan Pembayaran</span>
                                    </button>
                                </div>
                            @elseif ($transaction->payment_status === 'lunas')
                                <div class="pt-2">
                                    <span class="w-full py-2 px-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-xs inline-flex items-center justify-center gap-1.5">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span>Pembayaran Lunas</span>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $itemLines = $transaction->items->map(function ($item) {
                        return '- ' . $item->product_name . ' (' . $item->quantity_kg . ' Kg x Rp ' . number_format($item->price_per_kg, 0, ',', '.') . ') = Rp ' . number_format($item->subtotal, 0, ',', '.');
                    })->implode("\n");

                    $bankLines = $bankAccounts->isNotEmpty()
                        ? $bankAccounts->map(fn ($b) => '- ' . $b->bank_name . ': ' . $b->account_number . ' (a.n. ' . $b->account_holder . ')')->implode("\n")
                        : '- Hubungi penjual untuk nomor rekening tujuan';

                    $waText = "Halo Serean Tobacco, saya ingin konfirmasi pembayaran pesanan (Transfer Bank):\n\n"
                        . "No. Invoice: {$transaction->invoice_code}\n"
                        . "Nama Penerima: {$transaction->customer_name}\n"
                        . "No. WhatsApp: {$transaction->customer_phone}\n"
                        . "Alamat Tujuan: {$transaction->customer_address}"
                        . ($transaction->desa ? ", Desa {$transaction->desa}" : '')
                        . ($transaction->kecamatan ? ", Kec. {$transaction->kecamatan}" : '')
                        . ($transaction->kabupaten ? ", {$transaction->kabupaten}" : '') . "\n\n"
                        . "Detail Pesanan:\n{$itemLines}\n\n"
                        . "Total Berat: " . number_format($transaction->total_weight_kg) . " Kg\n"
                        . "Ongkos Kirim: Rp " . number_format($transaction->shipping_cost, 0, ',', '.') . "\n"
                        . "Total Tagihan: Rp " . number_format($transaction->total_price, 0, ',', '.') . "\n\n"
                        . "Metode Pembayaran: Transfer Bank\n"
                        . "Rekening Tujuan:\n{$bankLines}\n\n"
                        . "Pastikan saya mengirim/melampirkan foto bukti transfer pembayaran bersama pesan ini. Mohon segera diproses, terima kasih.";

                    $waUrl = 'https://wa.me/6287855320286?text=' . urlencode($waText);
                @endphp
            </div>

        </div>
    </div>

    @if ($transaction->shipping_status !== 'dibatalkan')
        <div id="modalPembayaran" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar space-y-5">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 border border-brand-gold/30 text-brand-gold flex items-center justify-center text-base shrink-0">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-lg text-brand-espresso">Pembayaran Transfer Bank</h3>
                            <p class="text-[11px] text-brand-muted">Invoice {{ $transaction->invoice_code }}</p>
                        </div>
                    </div>
                    <button type="button" onclick="document.getElementById('modalPembayaran').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-between">
                    <span class="text-xs font-semibold text-brand-muted">Total yang Harus Ditransfer</span>
                    <strong class="font-serif font-extrabold text-lg text-brand-gold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
                </div>

                <div class="space-y-2.5">
                    <span class="text-xs font-bold text-brand-espresso block">Nomor Rekening Tujuan Transfer:</span>
                    @if ($bankAccounts->isNotEmpty())
                        <div class="space-y-2.5">
                            @foreach ($bankAccounts as $bank)
                                <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-between gap-3">
                                    <div>
                                        <span class="font-bold text-brand-espresso text-xs block">{{ $bank->bank_name }}</span>
                                        <span class="font-mono font-bold text-sm text-brand-gold block mt-0.5">{{ $bank->account_number }}</span>
                                        <span class="text-[11px] text-brand-muted block">a.n. {{ $bank->account_holder }}</span>
                                    </div>
                                    <button type="button" onclick="navigator.clipboard.writeText('{{ $bank->account_number }}'); this.innerText='Tersalin';" class="px-3 py-1.5 rounded-lg bg-white hover:bg-stone-100 border border-brand-border text-[11px] font-bold text-brand-espresso transition-colors cursor-pointer shrink-0">
                                        Salin
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-brand-muted italic">Silakan hubungi penjual melalui tombol WhatsApp di bawah untuk mendapatkan nomor rekening tujuan.</p>
                    @endif
                </div>

                <div class="p-3.5 rounded-2xl bg-amber-50 border border-brand-gold/30 text-[11px] text-amber-900 leading-relaxed">
                    <i class="fa-solid fa-circle-info text-brand-gold mr-1"></i>
                    Setelah melakukan transfer, klik tombol di bawah untuk mengirim pesan lengkap pesanan ke WhatsApp penjual. <strong>Pastikan mengirim foto bukti pembayarannya juga.</strong>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-2.5 pt-1">
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="w-full py-3 px-5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-all inline-flex items-center justify-center gap-2 shadow-sm">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Kirim Pesanan &amp; Bukti Bayar via WA</span>
                    </a>
                </div>
            </div>
        </div>
    @endif

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

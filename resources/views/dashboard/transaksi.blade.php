@extends('dashboard.layout')

@section('title', 'Transaksi & Distribusi Armada — Serean Tobacco')
@section('page_title', 'Transaksi & Distribusi Armada')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Total Tonase Terjual</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ number_format($totalTonaseKg) }} Kg</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                <i class="fa-solid fa-weight-scale"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Armada Pick Up (&lt;300 Kg)</span>
                <span class="font-serif font-extrabold text-2xl text-amber-700 mt-1 block">{{ $pickUpCount }} Pengantaran</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-truck-pickup"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Tambahan Armada (&ge;300 Kg)</span>
                <span class="font-serif font-extrabold text-2xl text-emerald-700 mt-1 block">{{ $tambahanArmadaCount }} Pengantaran</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-truck-moving"></i>
            </div>
        </div>
    </div>

    <div class="p-4 rounded-2xl bg-amber-50/80 border border-brand-gold/30 text-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-2.5">
            <i class="fa-solid fa-circle-info text-brand-gold text-base shrink-0"></i>
            <span class="text-brand-espresso font-semibold">
                Aturan Distribusi Logistik Sentra: Pesanan dengan tonase &lt; 300 Kg otomatis dialokasikan menggunakan <strong>Mobil Pick Up</strong>. Untuk pesanan &ge; 300 Kg, sistem menginstruksikan <strong>Tambahan Armada Truk Kargo</strong>.
            </span>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
        <div class="block sm:hidden divide-y divide-brand-border">
            @forelse ($transactions as $trx)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="font-mono font-bold text-xs text-brand-gold block">{{ $trx->invoice_code }}</span>
                            <span class="font-bold text-brand-espresso text-sm block mt-0.5">{{ $trx->customer_name }}</span>
                            <span class="text-[11px] text-brand-muted block">{{ $trx->customer_phone }}</span>
                            <span class="text-[10px] text-stone-500 block mt-0.5">
                                {{ $trx->desa ? $trx->desa . ', ' . $trx->kecamatan . ', ' . $trx->kabupaten : $trx->customer_address }}
                            </span>
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
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $badgeClass }} shrink-0">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="p-2.5 rounded-xl bg-brand-surface border border-brand-border/60 text-xs space-y-1">
                        @foreach ($trx->items as $item)
                            <div class="flex justify-between text-[11px]">
                                <span class="text-brand-espresso font-semibold">{{ $item->product_name }}</span>
                                <span class="text-brand-muted">{{ $item->quantity_kg }} Kg</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs pt-1 border-t border-brand-border/60">
                        <div>
                            <span class="text-[10px] text-brand-muted block">Alokasi Armada</span>
                            @if ($trx->fleet_type === 'tambahan_armada')
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700">
                                    <i class="fa-solid fa-truck-moving text-[10px]"></i> Truk Kargo (&ge;300 Kg)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-800">
                                    <i class="fa-solid fa-truck-pickup text-[10px]"></i> Pick Up (&lt;300 Kg)
                                </span>
                            @endif
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] text-brand-muted block">Total Tagihan</span>
                            <span class="font-serif font-bold text-sm text-brand-espresso block">
                                Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                            </span>
                            @if ($trx->fleet_type === 'pick_up' && $trx->shipping_cost > 0)
                                <span class="text-[9px] text-amber-800 block">Ongkir 10%: Rp {{ number_format($trx->shipping_cost) }}</span>
                            @endif
                        </div>
                    </div>

                    @if (Auth::user()->isAdmin())
                        <div class="pt-2 border-t border-brand-border/60 flex justify-end">
                            <button type="button" onclick="openEditTransaksiModal({{ json_encode($trx) }})" class="px-4 py-1.5 rounded-full border border-brand-border hover:border-brand-gold bg-brand-surface text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1 cursor-pointer">
                                <i class="fa-regular fa-pen-to-square text-xs text-brand-gold"></i>
                                <span>Kelola Status &amp; Armada</span>
                            </button>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-brand-muted text-xs">
                    Belum ada transaksi penjualan tercatat.
                </div>
            @endforelse
        </div>

        <div class="hidden sm:block overflow-x-auto no-scrollbar">
            <table class="w-full text-left text-xs min-w-[760px]">
                <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-5 sm:px-6">Invoice &amp; Pembeli</th>
                        <th class="py-3.5 px-5 sm:px-6">Detail Item Pesanan</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center">Tonase (Kg)</th>
                        <th class="py-3.5 px-5 sm:px-6">Rekomendasi Armada</th>
                        <th class="py-3.5 px-5 sm:px-6 text-right">Total Biaya</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center">Status Kirim</th>
                        @if (Auth::user()->isAdmin())
                            <th class="py-3.5 px-5 sm:px-6 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border">
                    @forelse ($transactions as $trx)
                        <tr class="hover:bg-brand-surface/60 transition-colors">
                            <td class="py-4 px-5 sm:px-6">
                                <div>
                                    <span class="font-mono font-bold text-xs text-brand-gold block">{{ $trx->invoice_code }}</span>
                                    <span class="font-bold text-brand-espresso text-xs block mt-0.5">{{ $trx->customer_name }}</span>
                                    <span class="text-[11px] text-brand-muted block">{{ $trx->customer_phone }}</span>
                                    <span class="text-[10px] text-stone-500 block mt-0.5">
                                        {{ $trx->desa ? 'Desa ' . $trx->desa . ', Kec. ' . $trx->kecamatan . ', ' . $trx->kabupaten : $trx->customer_address }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-5 sm:px-6">
                                <div class="space-y-1">
                                    @foreach ($trx->items as $item)
                                        <div class="text-[11px]">
                                            <strong class="text-brand-espresso">{{ $item->product_name }}</strong>
                                            <span class="text-brand-muted">({{ $item->quantity_kg }} Kg @ Rp {{ number_format($item->price_per_kg) }})</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-center font-serif font-bold text-sm text-brand-espresso">
                                {{ number_format($trx->total_weight_kg) }} Kg
                            </td>
                            <td class="py-4 px-5 sm:px-6">
                                @if ($trx->fleet_type === 'tambahan_armada')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-300">
                                        <i class="fa-solid fa-truck-moving text-emerald-600"></i>
                                        <span>Tambahan Armada (&ge;300 Kg)</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-300">
                                        <i class="fa-solid fa-truck-pickup text-amber-600"></i>
                                        <span>Pick Up (&lt;300 Kg)</span>
                                    </span>
                                @endif
                                <span class="block text-[10px] text-stone-500 mt-0.5">Resi: {{ $trx->tracking_number ?? 'Menunggu Alokasi' }}</span>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-right font-serif font-bold text-brand-espresso">
                                Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                @if ($trx->fleet_type === 'pick_up' && $trx->shipping_cost > 0)
                                    <span class="block text-[10px] text-amber-800 font-sans">
                                        Ongkir: Rp {{ number_format($trx->shipping_cost) }}
                                    </span>
                                @elseif ($trx->fleet_type === 'tambahan_armada')
                                    <span class="block text-[10px] text-emerald-700 font-sans">
                                        Bebas Ongkir Kargo
                                    </span>
                                @endif
                                <span class="block text-[10px] font-normal uppercase {{ $trx->payment_status === 'lunas' ? 'text-emerald-700 font-bold' : 'text-amber-600' }}">
                                    {{ $trx->payment_status === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                </span>
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
                            @if (Auth::user()->isAdmin())
                                <td class="py-4 px-5 sm:px-6 text-center">
                                    <button type="button" onclick="openEditTransaksiModal({{ json_encode($trx) }})" class="px-3 py-1.5 rounded-full border border-brand-border hover:border-brand-gold bg-brand-surface text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1 cursor-pointer">
                                        <i class="fa-regular fa-pen-to-square text-xs text-brand-gold"></i>
                                        <span>Update</span>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 7 : 6 }}" class="py-12 text-center text-brand-muted text-xs">
                                Belum ada transaksi penjualan tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('modals')
    @if (Auth::user()->isAdmin())
        <div id="modalEditTransaksi" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Perbarui Status Transaksi &amp; Distribusi</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Ubah status logistik pengantaran dan pembayaran pembeli.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalEditTransaksi').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form id="formEditTransaksi" method="POST" class="space-y-4 pt-5 text-xs">
                    @csrf
                    @method('PUT')

                    <div class="p-3 rounded-xl bg-brand-surface border border-brand-border">
                        <span class="text-[11px] text-brand-muted block">Kode Invoice:</span>
                        <span id="trx_invoice" class="font-mono font-bold text-sm text-brand-gold block"></span>
                        <span id="trx_customer" class="text-xs font-bold text-brand-espresso block mt-0.5"></span>
                        <span id="trx_fleet_recommendation" class="inline-block mt-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-brand-espresso"></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Status Pengiriman <span class="text-red-500">*</span></label>
                            <select id="trx_shipping_status" name="shipping_status" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                                <option value="menunggu_konfirmasi">Menunggu Konfirmasi</option>
                                <option value="diproses">Diproses Gudang</option>
                                <option value="dalam_pengiriman">Dalam Pengiriman</option>
                                <option value="terkirim">Terkirim</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Status Pembayaran <span class="text-red-500">*</span></label>
                            <select id="trx_payment_status" name="payment_status" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-xs transition-colors">
                                <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                                <option value="lunas">Lunas</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nomor Resi / Pelacakan Kargo</label>
                        <input type="text" id="trx_tracking_number" name="tracking_number" placeholder="Contoh: SRN-TRK-7841" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Estimasi Tiba</label>
                        <input type="text" id="trx_estimated_delivery" name="estimated_delivery" placeholder="Contoh: 28 Nov 2026" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Catatan Distribusi Pelacakan</label>
                        <textarea id="trx_tracking_notes" name="tracking_notes" rows="3" placeholder="Informasi muatan, unit armada yang membawa, atau status transit..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalEditTransaksi').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditTransaksiModal(trx) {
                const form = document.getElementById('formEditTransaksi');
                form.action = '/dashboard/transaksi/' + trx.id;
                document.getElementById('trx_invoice').textContent = trx.invoice_code;
                document.getElementById('trx_customer').textContent = trx.customer_name + ' • Total ' + trx.total_weight_kg + ' Kg';
                document.getElementById('trx_fleet_recommendation').textContent = trx.fleet_name;
                document.getElementById('trx_shipping_status').value = trx.shipping_status;
                document.getElementById('trx_payment_status').value = trx.payment_status;
                document.getElementById('trx_tracking_number').value = trx.tracking_number || '';
                document.getElementById('trx_estimated_delivery').value = trx.estimated_delivery || '';
                document.getElementById('trx_tracking_notes').value = trx.tracking_notes || '';
                document.getElementById('modalEditTransaksi').classList.remove('hidden');
            }
        </script>
    @endif
@endpush

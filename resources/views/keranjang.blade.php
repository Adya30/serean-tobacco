@extends('layouts.app')

@section('title', 'Keranjang Tembakau — Serean Tobacco')

@section('content')
    <div class="pt-28 pb-20 min-h-[85vh]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div>
                <h1 class="font-serif font-extrabold text-2xl sm:text-3xl text-brand-espresso">
                    Keranjang Belanja Tembakau
                </h1>
                <p class="text-xs sm:text-sm text-brand-muted mt-1">
                    Daftar varietas tembakau pilihan siap dikirim langsung dari gudang Situbondo.
                </p>
            </div>

            @if (session('status'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                <div class="lg:col-span-7 space-y-4">
                    @forelse ($cartItems as $item)
                        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-brand-border shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-16 h-16 rounded-xl bg-cover bg-center shrink-0 border border-brand-border bg-stone-100 flex items-center justify-center text-brand-gold font-serif font-bold text-lg" style="{{ ($item->product->image_url ?? $item->product->image) ? "background-image: url('" . ($item->product->image_url ?? asset($item->product->image)) . "');" : '' }}">
                                    @if (!($item->product->image_url ?? $item->product->image))
                                        <i class="fa-solid fa-leaf"></i>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h3 class="font-serif font-bold text-sm text-brand-espresso leading-snug">{{ $item->product->name }}</h3>
                                    <p class="text-xs text-brand-muted mt-0.5">{{ $item->product->variety }} • {{ $item->product->origin }}</p>
                                    <span class="text-xs font-bold text-brand-gold mt-1 inline-block">Rp {{ number_format($item->product->price_per_kg, 0, ',', '.') }} / kg</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between w-full sm:w-auto gap-5 pt-3 sm:pt-0 border-t sm:border-t-0 border-brand-border shrink-0">
                                <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center gap-1.5">
                                    @csrf
                                    @method('PUT')
                                    <span class="text-xs text-brand-muted">Jumlah:</span>
                                    <input type="number" name="quantity_kg" value="{{ $item->quantity_kg }}" min="1" class="w-16 px-2 py-1 text-xs rounded-lg border border-brand-border text-center font-bold text-brand-espresso focus:border-brand-gold focus:outline-none" onchange="this.form.submit()">
                                    <span class="text-xs font-semibold text-brand-muted">Kg</span>
                                </form>

                                <div class="text-right shrink-0">
                                    <span class="font-serif font-bold text-sm text-brand-espresso block whitespace-nowrap">
                                        Rp {{ number_format($item->quantity_kg * $item->product->price_per_kg, 0, ',', '.') }}
                                    </span>
                                    <form action="{{ route('keranjang.remove', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[11px] text-red-500 hover:text-red-700 underline cursor-pointer mt-0.5">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 rounded-2xl bg-white border border-brand-border text-center space-y-3">
                            <div class="w-14 h-14 rounded-full bg-stone-100 text-stone-400 mx-auto flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <h3 class="font-serif font-bold text-lg text-brand-espresso">Keranjang Masih Kosong</h3>
                            <p class="text-xs text-brand-muted max-w-sm mx-auto">
                                Anda belum menambahkan varietas tembakau ke dalam keranjang belanja.
                            </p>
                            <a href="{{ route('produk') }}" class="inline-block mt-2 px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-bold hover:bg-brand-dark transition-colors">
                                Jelajahi Produk
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white p-6 sm:p-7 rounded-2xl border border-brand-border shadow-sm space-y-5 sticky top-24">
                        <h3 class="font-serif font-bold text-base text-brand-espresso border-b border-brand-border pb-3">
                            Ringkasan Pesanan &amp; Logistik
                        </h3>

                        <div class="space-y-3 text-xs text-brand-muted">
                            <div class="flex items-center justify-between gap-4">
                                <span>Total Berat (Tonase)</span>
                                <span class="font-bold text-brand-espresso whitespace-nowrap">{{ number_format($totalWeight) }} Kg</span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span>Subtotal Belanja</span>
                                <span class="font-bold text-brand-espresso whitespace-nowrap">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span>Jasa Ongkir</span>
                                <span id="summary-ongkir-badge" class="font-bold whitespace-nowrap {{ $totalWeight < 300 ? 'text-amber-800' : 'text-emerald-700' }}">
                                    @if ($totalWeight < 300)
                                        Rp {{ number_format(round($totalPrice * 0.10), 0, ',', '.') }} (10%)
                                    @else
                                        Rp 0 (Gratis Ongkir)
                                    @endif
                                </span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span>Lokasi Asal Gudang</span>
                                <span class="font-bold text-brand-espresso whitespace-nowrap">Situbondo, Jatim</span>
                            </div>
                            <div class="border-t border-brand-border pt-3.5 flex items-center justify-between gap-4 text-sm">
                                <span class="font-bold text-brand-espresso">Total Tagihan</span>
                                <span id="summary-grand-total" class="font-serif font-extrabold text-base text-brand-gold whitespace-nowrap">
                                    @php
                                        $initialOngkir = $totalWeight < 300 ? round($totalPrice * 0.10) : 0;
                                        $initialGrandTotal = $totalPrice + $initialOngkir;
                                    @endphp
                                    Rp {{ number_format($initialGrandTotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        @if ($totalPrice > 0)
                            @auth
                                <div class="pt-1">
                                    <button type="button" onclick="document.getElementById('modalTransferKeranjang').classList.remove('hidden')" class="w-full py-3 px-4 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs hover:bg-brand-dark transition-all flex items-center justify-center gap-2 shadow cursor-pointer">
                                        <i class="fa-solid fa-credit-card text-brand-gold"></i>
                                        <span>Bayar Sekarang</span>
                                    </button>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="w-full py-3 px-4 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs hover:bg-brand-dark transition-all flex items-center justify-center gap-2 shadow text-center">
                                    <span>Masuk untuk Checkout</span>
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if ($totalPrice > 0)
        @auth
            <div id="modalTransferKeranjang" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
                <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar space-y-5">
                    <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 border border-brand-gold/30 text-brand-gold flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <div>
                                <h3 class="font-serif font-bold text-lg text-brand-espresso">Pembayaran Transfer Bank</h3>
                                <p class="text-[11px] text-brand-muted">Pembayaran hanya melalui transfer ke rekening berikut.</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('modalTransferKeranjang').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark flex items-center justify-center transition-colors cursor-pointer">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>

                    <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border flex items-center justify-between">
                        <span class="text-xs font-semibold text-brand-muted">Total yang Harus Ditransfer</span>
                        <strong class="font-serif font-extrabold text-lg text-brand-gold">Rp {{ number_format($initialGrandTotal, 0, ',', '.') }}</strong>
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
                            <p class="text-xs text-brand-muted italic">Nomor rekening akan dikonfirmasi melalui WhatsApp penjual setelah lanjut ke detail pesanan.</p>
                        @endif
                    </div>

                    <div class="p-3.5 rounded-2xl bg-amber-50 border border-brand-gold/30 text-[11px] text-amber-900 leading-relaxed">
                        <i class="fa-solid fa-circle-info text-brand-gold mr-1"></i>
                        Setelah transfer, klik <strong>Lanjut ke Detail</strong> untuk membuat pesanan dan mengirim rincian lengkap beserta <strong>foto bukti pembayarannya</strong> ke WhatsApp penjual.
                    </div>

                    <form action="{{ route('customer.transaksi.store') }}" method="POST" class="flex items-center justify-end gap-2.5 pt-1">
                        @csrf
                        <button type="button" onclick="document.getElementById('modalTransferKeranjang').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 text-xs font-semibold cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 py-3 px-5 rounded-full bg-brand-espresso hover:bg-brand-dark text-white font-bold text-xs transition-all inline-flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                            <span>Lanjut ke Detail</span>
                            <i class="fa-solid fa-arrow-right text-[11px]"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    @endif
@endsection

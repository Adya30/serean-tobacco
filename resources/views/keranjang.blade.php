@extends('layouts.app')

@section('title', 'Keranjang Tembakau — Serean Tobacco')

@section('content')
    <div class="pt-28 pb-20 min-h-[85vh]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div>
                <span class="text-xs font-bold text-brand-gold uppercase tracking-wider">Pemesanan Langsung Sentra</span>
                <h1 class="font-serif font-extrabold text-2xl sm:text-3xl text-brand-espresso mt-1">
                    Keranjang Belanja Tembakau
                </h1>
                <p class="text-xs sm:text-sm text-brand-muted mt-1">
                    Daftar varietas tembakau rajangan pilihan dari database siap dikirim langsung dari gudang Situbondo.
                </p>
            </div>

            @if (session('status'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8 space-y-4">
                    @forelse ($cartItems as $item)
                        <div class="p-4 sm:p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-16 h-16 rounded-xl bg-cover bg-center shrink-0 border border-brand-border bg-stone-100 flex items-center justify-center text-brand-gold font-serif font-bold text-lg" style="{{ ($item->product->image_url ?? $item->product->image) ? "background-image: url('" . ($item->product->image_url ?? asset($item->product->image)) . "');" : '' }}">
                                    @if (!($item->product->image_url ?? $item->product->image))
                                        <i class="fa-solid fa-leaf"></i>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-serif font-bold text-sm sm:text-base text-brand-espresso">{{ $item->product->name }}</h3>
                                    <p class="text-xs text-brand-muted mt-0.5">{{ $item->product->variety }} • {{ $item->product->origin }}</p>
                                    <span class="text-xs font-bold text-brand-gold mt-1 inline-block">Rp {{ number_format($item->product->price_per_kg) }} / kg</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between w-full sm:w-auto gap-4 pt-2 sm:pt-0 border-t sm:border-t-0 border-brand-border">
                                <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center gap-1.5">
                                    @csrf
                                    @method('PUT')
                                    <span class="text-xs text-brand-muted">Jumlah:</span>
                                    <input type="number" name="quantity_kg" value="{{ $item->quantity_kg }}" min="1" class="w-16 px-2 py-1 text-xs rounded-lg border border-brand-border text-center font-bold text-brand-espresso focus:border-brand-gold focus:outline-none" onchange="this.form.submit()">
                                    <span class="text-xs font-semibold text-brand-muted">Kg</span>
                                </form>

                                <div class="text-right">
                                    <span class="font-serif font-bold text-sm text-brand-espresso block">
                                        Rp {{ number_format($item->quantity_kg * $item->product->price_per_kg) }}
                                    </span>
                                    <form action="{{ route('keranjang.remove', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-[11px] text-red-500 hover:text-red-700 underline cursor-pointer">
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

                <div class="lg:col-span-4">
                    <div class="bg-white p-6 rounded-2xl border border-brand-border shadow-sm space-y-5 sticky top-24">
                        <h3 class="font-serif font-bold text-base text-brand-espresso border-b border-brand-border pb-3">
                            Ringkasan Pesanan &amp; Logistik
                        </h3>

                        <div class="space-y-2.5 text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Total Berat (Tonase)</span>
                                <span class="font-bold text-brand-espresso">{{ number_format($totalWeight) }} Kg</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Subtotal Belanja Tembakau</span>
                                <span class="font-bold text-brand-espresso">Rp {{ number_format($totalPrice) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Ongkos Kirim Armada</span>
                                <span id="summary-ongkir-badge" class="font-bold {{ $totalWeight < 300 ? 'text-amber-800' : 'text-emerald-700' }}">
                                    @if ($totalWeight < 300)
                                        Rp {{ number_format(round($totalPrice * 0.10)) }} (10%)
                                    @else
                                        Rp 0 (Bebas Ongkir Kargo)
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span>Lokasi Asal Gudang</span>
                                <span class="font-bold text-brand-espresso">Situbondo, Jatim</span>
                            </div>
                            <div class="border-t border-brand-border pt-3 flex justify-between text-sm">
                                <span class="font-bold text-brand-espresso">Total Tagihan</span>
                                <span id="summary-grand-total" class="font-serif font-extrabold text-base text-brand-gold">
                                    @php
                                        $initialOngkir = $totalWeight < 300 ? round($totalPrice * 0.10) : 0;
                                        $initialGrandTotal = $totalPrice + $initialOngkir;
                                    @endphp
                                    Rp {{ number_format($initialGrandTotal) }}
                                </span>
                            </div>
                        </div>

                        @if ($totalPrice > 0)
                            @auth
                                <form action="{{ route('customer.transaksi.store') }}" method="POST" class="space-y-3.5 pt-2">
                                    @csrf

                                    <div>
                                        <label class="block font-semibold text-brand-espresso text-[11px] mb-1">Nama Penerima</label>
                                        <input type="text" name="customer_name" value="{{ Auth::user()->name }}" required class="w-full px-3 py-2 text-xs rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold">
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-brand-espresso text-[11px] mb-1">Nomor WhatsApp Penerima</label>
                                        <input type="tel" name="customer_phone" value="{{ Auth::user()->phone ?? '081234567890' }}" required class="w-full px-3 py-2 text-xs rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold">
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-2.5">
                                        <div>
                                            <label class="block font-semibold text-brand-espresso text-[11px] mb-1">Kabupaten/Kota</label>
                                            <input type="text" name="kabupaten" value="{{ Auth::user()->kabupaten ?? '' }}" required placeholder="cth: Situbondo" class="w-full px-3 py-2 text-xs rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold">
                                        </div>
                                        <div>
                                            <label class="block font-semibold text-brand-espresso text-[11px] mb-1">Kecamatan</label>
                                            <input type="text" name="kecamatan" value="{{ Auth::user()->kecamatan ?? '' }}" required placeholder="cth: Panji" class="w-full px-3 py-2 text-xs rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold">
                                        </div>
                                        <div>
                                            <label class="block font-semibold text-brand-espresso text-[11px] mb-1">Desa/Kelurahan</label>
                                            <input type="text" name="desa" value="{{ Auth::user()->desa ?? '' }}" required placeholder="cth: Curah Jeru" class="w-full px-3 py-2 text-xs rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block font-semibold text-brand-espresso text-[11px] mb-1">Detail Alamat / Jalan / RT RW</label>
                                        <textarea name="customer_address" rows="2" required placeholder="Nama jalan, nomor rumah, RT/RW, atau patokan..." class="w-full px-3 py-2 text-xs rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold">{{ Auth::user()->address ?? '' }}</textarea>
                                    </div>

                                    <div class="space-y-1.5 pt-1">
                                        <label class="block font-semibold text-brand-espresso text-[11px]">Pilihan Metode Pengantaran &amp; Armada</label>
                                        <div class="space-y-2">
                                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-brand-border bg-brand-surface hover:bg-stone-50 cursor-pointer has-[:checked]:border-brand-gold has-[:checked]:bg-amber-50/50 transition-all">
                                                <input type="radio" name="fleet_type" value="pick_up" {{ $totalWeight < 300 ? 'checked' : '' }} onchange="updateDeliveryCalculation('pick_up')" class="mt-0.5 text-brand-espresso focus:ring-brand-gold">
                                                <div class="text-[11px] flex-1 min-w-0">
                                                    <div class="flex flex-wrap items-center justify-between gap-1.5">
                                                        <strong class="text-brand-espresso">Armada Pick Up (&lt;300 Kg)</strong>
                                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 whitespace-nowrap shrink-0">
                                                            Ongkir 10% Belanja
                                                        </span>
                                                    </div>
                                                    <p class="text-brand-muted mt-1 text-[10px] leading-relaxed">
                                                        Biaya ongkir 10% dari total belanjaan tembakau (Rp {{ number_format(round($totalPrice * 0.10)) }}). Alokasi mobil pick up standar sentra pengolahan.
                                                    </p>
                                                </div>
                                            </label>

                                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-brand-border bg-brand-surface hover:bg-stone-50 cursor-pointer has-[:checked]:border-brand-gold has-[:checked]:bg-emerald-50/40 transition-all">
                                                <input type="radio" name="fleet_type" value="tambahan_armada" {{ $totalWeight >= 300 ? 'checked' : '' }} onchange="updateDeliveryCalculation('tambahan_armada')" class="mt-0.5 text-brand-espresso focus:ring-brand-gold">
                                                <div class="text-[11px] flex-1 min-w-0">
                                                    <div class="flex flex-wrap items-center justify-between gap-1.5">
                                                        <strong class="text-brand-espresso">Tambahan Armada Truk Kargo (&ge;300 Kg)</strong>
                                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 whitespace-nowrap shrink-0">
                                                            Bebas Ongkir Kargo
                                                        </span>
                                                    </div>
                                                    <p class="text-brand-muted mt-0.5 text-[10px] leading-relaxed">
                                                        Rekomendasi otomatis pengiriman partai besar &ge; 300 Kg menggunakan truk kargo sentra. Bebas biaya ongkir tambahan.
                                                    </p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full py-3 px-4 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs hover:bg-brand-dark transition-all flex items-center justify-center gap-2 shadow cursor-pointer mt-2">
                                        <i class="fa-solid fa-truck-fast text-brand-gold"></i>
                                        <span>Proses Checkout &amp; Alokasi Armada</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full py-3 px-4 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs hover:bg-brand-dark transition-all flex items-center justify-center gap-2 shadow text-center">
                                    <span>Masuk untuk Checkout</span>
                                </a>
                            @endauth

                            <a 
                                href="https://wa.me/6287855320286?text={{ urlencode('Halo Admin Serean Tobacco, saya ingin konfirmasi pesanan tembakau dengan total ' . $totalWeight . ' Kg senilai Rp ' . number_format($totalPrice) . '. Rekomendasi armada: ' . ($totalWeight >= 300 ? 'Tambahan Armada Truk' : 'Armada Pick Up') . '. Mohon informasi jadwal pengiriman.') }}"
                                target="_blank"
                                class="w-full py-2.5 px-4 rounded-xl bg-white border border-brand-border hover:border-emerald-500 text-emerald-700 font-bold text-xs transition-colors flex items-center justify-center gap-2 shadow-xs"
                            >
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                <span>Hubungi Sentra via WhatsApp</span>
                            </a>
                        @endif

                        <p class="text-[10px] text-brand-muted text-center leading-relaxed">
                            Pesanan langsung diverifikasi oleh admin gudang. Timbangan akurat &amp; garansi aroma tembakau asli.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const subtotalBelanja = {{ $totalPrice }};

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function updateDeliveryCalculation(fleetType) {
            const ongkirBadge = document.getElementById('summary-ongkir-badge');
            const grandTotalEl = document.getElementById('summary-grand-total');

            if (!ongkirBadge || !grandTotalEl) return;

            if (fleetType === 'pick_up') {
                const ongkir = Math.round(subtotalBelanja * 0.10);
                const grandTotal = subtotalBelanja + ongkir;
                ongkirBadge.innerText = `Rp ${formatRupiah(ongkir)} (10%)`;
                ongkirBadge.className = 'font-bold text-amber-800';
                grandTotalEl.innerText = `Rp ${formatRupiah(grandTotal)}`;
            } else {
                ongkirBadge.innerText = 'Rp 0 (Bebas Ongkir Kargo)';
                ongkirBadge.className = 'font-bold text-emerald-700';
                grandTotalEl.innerText = `Rp ${formatRupiah(subtotalBelanja)}`;
            }
        }
    </script>
@endsection

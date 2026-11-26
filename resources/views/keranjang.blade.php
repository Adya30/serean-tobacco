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
                                <div class="w-16 h-16 rounded-xl bg-cover bg-center shrink-0 border border-brand-border bg-stone-100 flex items-center justify-center text-brand-gold font-serif font-bold text-lg" style="{{ $item->product->image ? "background-image: url('" . asset($item->product->image) . "');" : '' }}">
                                    @if (!$item->product->image)
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
                            Ringkasan Pesanan
                        </h3>

                        <div class="space-y-2.5 text-xs text-brand-muted">
                            <div class="flex justify-between">
                                <span>Total Berat</span>
                                <span class="font-bold text-brand-espresso">{{ $totalWeight }} Kg</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Status Stok</span>
                                <span class="font-bold text-emerald-700">Tersedia di Gudang</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Lokasi Asal</span>
                                <span class="font-bold text-brand-espresso">Situbondo, Jatim</span>
                            </div>
                            <div class="border-t border-brand-border pt-3 flex justify-between text-sm">
                                <span class="font-bold text-brand-espresso">Total Tagihan</span>
                                <span class="font-serif font-extrabold text-base text-brand-gold">Rp {{ number_format($totalPrice) }}</span>
                            </div>
                        </div>

                        @if ($totalPrice > 0)
                            <a 
                                href="https://wa.me/6287855320286?text={{ urlencode('Halo Admin Serean Tobacco, saya ingin checkout pesanan tembakau dengan total ' . $totalWeight . ' Kg senilai Rp ' . number_format($totalPrice) . '. Mohon informasi rekening dan jadwal pengiriman.') }}"
                                target="_blank"
                                class="w-full py-3.5 px-4 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs sm:text-sm hover:bg-brand-dark transition-colors flex items-center justify-center gap-2 shadow"
                            >
                                <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i>
                                <span>Checkout via WhatsApp</span>
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
@endsection

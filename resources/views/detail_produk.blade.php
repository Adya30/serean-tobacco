@extends('layouts.app')

@section('title', $product->name . ' — Serean Tobacco')
@section('meta_description', $product->description ?? 'Detail produk tembakau pilihan Serean Tobacco.')

@section('content')

    <section class="pt-28 pb-16 min-h-[85vh] bg-brand-surface">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div>
                <a href="{{ route('produk') }}" class="text-xs font-bold text-brand-gold hover:underline inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Katalog Produk</span>
                </a>
            </div>

            <div class="bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    <div class="lg:col-span-5">
                        <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden bg-stone-100 border border-brand-border">
                            @if ($product->image_url ?? $product->image)
                                <img src="{{ $product->image_url ?? asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-stone-300 text-4xl">
                                    <i class="fa-solid fa-leaf"></i>
                                </div>
                            @endif
                            <span class="absolute bottom-3 right-3 px-3 py-1 rounded-full {{ $product->stock_kg > 0 ? 'bg-brand-dark/85 text-white' : 'bg-red-600/85 text-white' }} backdrop-blur-sm text-[11px] font-semibold">
                                {{ $product->stock_kg > 0 ? 'Ready Stock' : 'Stok Habis' }}
                            </span>
                        </div>
                    </div>

                    <div class="lg:col-span-7 space-y-5 text-xs">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[11px] font-bold">
                                    Grade {{ $product->grade ?? 'CW' }}
                                </span>
                                <span class="text-xs text-brand-muted font-medium">
                                    {{ $product->moisture_content ?? 'Rajang Halus' }}
                                </span>
                            </div>
                            <span class="text-xs text-brand-muted">
                                <i class="fa-solid fa-location-dot text-brand-gold mr-1"></i>{{ $product->origin ?? 'Situbondo' }}
                            </span>
                        </div>

                        <div>
                            <h1 class="font-serif font-extrabold text-xl sm:text-2xl text-[#1a0f07] leading-snug">
                                {{ $product->name }}
                            </h1>
                            <p class="text-xs sm:text-sm text-brand-muted leading-relaxed mt-2">
                                {{ $product->description ?? 'Varietas tembakau bermutu tinggi hasil pengolahan presisi sentra Serean.' }}
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-3 p-4 rounded-2xl bg-brand-surface border border-brand-border text-center">
                            <div>
                                <span class="text-[10px] text-brand-muted block">Varietas</span>
                                <strong class="text-brand-espresso text-xs sm:text-sm block mt-0.5">{{ $product->variety }}</strong>
                            </div>
                            <div>
                                <span class="text-[10px] text-brand-muted block">Stok Tersedia</span>
                                <strong class="text-brand-espresso text-xs sm:text-sm block mt-0.5">{{ number_format($product->stock_kg) }} Kg</strong>
                            </div>
                            <div>
                                <span class="text-[10px] text-brand-muted block">Harga / Kg</span>
                                <strong class="text-brand-gold text-xs sm:text-sm block mt-0.5">Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 rounded-2xl bg-brand-surface border border-brand-border space-y-3">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <label for="detail_qty_kg" class="font-bold text-brand-espresso text-xs sm:text-sm">Jumlah Pesanan (Kg)</label>
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="adjustDetailQty(-1)" class="w-9 h-9 rounded-xl bg-white border border-brand-border hover:border-brand-gold text-brand-espresso font-bold cursor-pointer">-</button>
                                    <input type="number" id="detail_qty_kg" min="1" value="1" oninput="updateDetailSubtotal()" class="w-20 px-2 py-2 text-center rounded-xl border border-brand-border bg-white font-bold text-brand-espresso text-xs focus:outline-none focus:border-brand-gold">
                                    <button type="button" onclick="adjustDetailQty(1)" class="w-9 h-9 rounded-xl bg-white border border-brand-border hover:border-brand-gold text-brand-espresso font-bold cursor-pointer">+</button>
                                    <span class="text-xs font-semibold text-brand-muted ml-1">Kg</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-brand-border">
                                <span class="text-brand-muted font-medium">Estimasi Subtotal</span>
                                <strong id="detail_subtotal" class="font-serif font-extrabold text-base text-brand-espresso">
                                    Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>

                        <div class="pt-1">
                            @auth
                                <button type="button" onclick="submitDetailToCart()" class="w-full py-3.5 px-6 rounded-full bg-brand-espresso hover:bg-brand-dark text-white text-xs sm:text-sm font-bold transition-all inline-flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                                    <i class="fa-solid fa-cart-plus text-brand-gold"></i>
                                    <span>Tambah ke Keranjang</span>
                                </button>
                            @else
                                <button type="button" onclick="document.getElementById('modalGuestAuth').classList.remove('hidden')" class="w-full py-3.5 px-6 rounded-full bg-brand-espresso hover:bg-brand-dark text-white text-xs sm:text-sm font-bold transition-all inline-flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                                    <i class="fa-solid fa-cart-plus text-brand-gold"></i>
                                    <span>Tambah ke Keranjang</span>
                                </button>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <div id="cartToast" class="fixed bottom-5 right-5 z-50 hidden">
        <div class="px-4 py-3 rounded-2xl bg-white text-brand-espresso shadow-lg border border-brand-border flex items-center gap-2.5 text-xs font-semibold">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>Barang berhasil masuk keranjang</span>
        </div>
    </div>

    @guest
        <div id="modalGuestAuth" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative text-center">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-brand-gold border border-brand-gold/30 flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                    <i class="fa-solid fa-user-lock"></i>
                </div>
                <h3 class="font-serif font-extrabold text-xl text-brand-espresso tracking-tight mb-2">
                    Silakan Masuk atau Buat Akun
                </h3>
                <p class="text-xs text-brand-muted leading-relaxed mb-6">
                    Untuk melakukan pemesanan produk <strong class="text-brand-espresso">"{{ $product->name }}"</strong>, silakan masuk ke akun Anda atau daftarkan akun baru terlebih dahulu.
                </p>

                <div class="space-y-2.5">
                    <a href="{{ route('login') }}" class="w-full py-3 px-5 rounded-full bg-brand-espresso text-white text-xs font-bold hover:bg-brand-dark transition-all inline-flex items-center justify-center gap-2 shadow-sm">
                        <i class="fa-solid fa-arrow-right-to-bracket text-brand-gold text-xs"></i>
                        <span>Masuk ke Akun (Login)</span>
                    </a>
                    <a href="{{ route('register') }}" class="w-full py-3 px-5 rounded-full bg-brand-surface border border-brand-gold/40 text-brand-espresso text-xs font-bold hover:bg-amber-50 transition-all inline-flex items-center justify-center gap-2">
                        <i class="fa-solid fa-user-plus text-brand-gold text-xs"></i>
                        <span>Daftar Akun Baru (Register)</span>
                    </a>
                    <button type="button" onclick="document.getElementById('modalGuestAuth').classList.add('hidden')" class="w-full py-2.5 text-xs text-brand-muted hover:text-brand-espresso font-semibold transition-colors cursor-pointer">
                        Nanti Saja
                    </button>
                </div>
            </div>
        </div>
    @endguest

    <script>
        const productPricePerKg = {{ $product->price_per_kg }};
        let toastTimer = null;

        function adjustDetailQty(delta) {
            const input = document.getElementById('detail_qty_kg');
            input.value = Math.max(1, (parseInt(input.value, 10) || 1) + delta);
            updateDetailSubtotal();
        }

        function updateDetailSubtotal() {
            const qty = Math.max(1, parseInt(document.getElementById('detail_qty_kg').value, 10) || 1);
            document.getElementById('detail_subtotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(qty * productPricePerKg);
        }

        function showCartToast() {
            const toast = document.getElementById('cartToast');
            toast.classList.remove('hidden');
            if (toastTimer) clearTimeout(toastTimer);
            toastTimer = setTimeout(function () {
                toast.classList.add('hidden');
            }, 4000);
        }

        function submitDetailToCart() {
            const qty = Math.max(1, parseInt(document.getElementById('detail_qty_kg').value, 10) || 1);
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('product_id', '{{ $product->id }}');
            formData.append('quantity_kg', qty);

            fetch('{{ route('keranjang.add') }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(function (res) {
                if (res.status === 401) {
                    return res.json().then(function (data) {
                        if (data.redirect) window.location.href = data.redirect;
                        throw new Error('Unauthorized');
                    });
                }
                return res.json();
            })
            .then(function (data) {
                const badge = document.getElementById('navbar-cart-badge');
                if (badge && typeof data.cart_count !== 'undefined') {
                    badge.textContent = data.cart_count;
                    badge.classList.remove('hidden');
                    badge.classList.add('flex');
                }
                showCartToast();
            })
            .catch(function () {});
        }
    </script>

@endsection

@extends('layouts.app')

@section('title', 'Katalog Varietas Tembakau & Daftar Grade 2026 — Serean Tobacco')
@section('meta_description', 'Katalog varietas tembakau rajangan halus Nusantara: Tembakau Opot (Besuki Na-Oogst), Samporis, Marakot, dan Baleno dengan daftar harga resmi grade 2026.')

@section('content')

    <section class="pt-28 sm:pt-36 pb-10 sm:pb-14 border-b border-brand-border bg-gradient-to-b from-brand-surface to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <h1 class="font-serif text-2xl sm:text-3xl lg:text-[32px] font-extrabold text-[#1a0f07] leading-tight max-w-4xl tracking-tight">
                Koleksi Varietas Tembakau &amp; Daftar Grade 2026
            </h1>
            <p class="text-xs sm:text-sm text-brand-muted mt-3 max-w-2xl leading-relaxed">
                Menyediakan 4 varietas tembakau unggulan: Tembakau Opot (Besuki Na-Oogst), Samporis, Marakot, dan Baleno dalam pilihan rajang halus maupun rajang kasar.
            </p>
        </div>
    </section>

    <section id="koleksi-produk" class="py-12 sm:py-16 border-b border-brand-border bg-brand-surface relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
 
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="p-6 rounded-3xl border border-brand-border bg-white flex flex-col justify-between hover:border-brand-gold hover:shadow-xl transition-all duration-300 group">
                        <div>
                            <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden mb-4 bg-stone-100 shadow-inner">
                                @if ($product->image_url ?? $product->image)
                                    <img src="{{ $product->image_url ?? asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-stone-300 text-3xl">
                                        <i class="fa-solid fa-leaf"></i>
                                    </div>
                                @endif
                                <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-brand-gold uppercase tracking-wider shadow">
                                    {{ $product->origin ?? 'Nusantara' }}
                                </span>
                                <span class="absolute bottom-2.5 right-2.5 px-2.5 py-0.5 rounded-full {{ $product->stock_kg > 0 ? 'bg-brand-dark/80 text-white' : 'bg-red-600/80 text-white' }} backdrop-blur-sm text-[10px] font-medium shadow">
                                    {{ $product->stock_kg > 0 ? 'Ready Stock' : 'Stok Habis' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="px-2 py-0.5 rounded-md bg-amber-100 text-brand-espresso text-[10px] font-bold">Grade {{ $product->grade ?? 'CW' }}</span>
                                <span class="text-[11px] text-brand-muted">{{ $product->moisture_content ?? 'Rajang Halus' }}</span>
                            </div>

                            <h3 class="font-serif font-extrabold text-sm sm:text-base text-[#1a0f07] mb-1.5">{{ $product->name }}</h3>
                            <p class="text-xs text-brand-muted leading-relaxed mb-4 line-clamp-2">
                                {{ $product->description ?? 'Varietas tembakau rajangan halus bermutu tinggi hasil pengolahan presisi sentra Serean.' }}
                            </p>

                            <div class="space-y-1.5 py-3 border-y border-brand-border text-xs text-brand-muted">
                                <div class="flex justify-between">
                                    <span>Varietas:</span>
                                    <strong class="text-brand-espresso">{{ $product->variety }}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span>Stok Siap Kirim:</span>
                                    <strong class="text-brand-espresso">{{ number_format($product->stock_kg) }} Kg</strong>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-brand-muted block uppercase">Harga Mulai</span>
                                <span class="font-serif font-bold text-sm text-brand-espresso">Rp {{ number_format($product->price_per_kg, 0, ',', '.') }}<span class="text-xs font-normal text-brand-muted">/kg</span></span>
                            </div>

                            @auth
                                <form action="{{ route('keranjang.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity_kg" value="1">
                                    <button type="submit" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                                        <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                        <span>Pesan</span>
                                    </button>
                                </form>
                            @else
                                <button type="button" onclick="openGuestAuthModal('{{ addslashes($product->name) }}')" class="px-4 py-2 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-colors shadow-sm inline-flex items-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                    <span>Pesan</span>
                                </button>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-12 text-center text-xs text-brand-muted bg-brand-surface rounded-3xl border border-brand-border">
                        Belum ada produk tembakau yang dipublikasikan di katalog etalase saat ini.
                    </div>
                @endforelse
            </div>

            <div id="modalGuestAuth" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
                <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative text-center">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-brand-gold border border-brand-gold/30 flex items-center justify-center mx-auto mb-4 text-2xl shadow-sm">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <h3 class="font-serif font-extrabold text-xl text-brand-espresso tracking-tight mb-2">
                        Silakan Masuk atau Buat Akun
                    </h3>
                    <p class="text-xs text-brand-muted leading-relaxed mb-6">
                        Untuk melakukan pemesanan produk tembakau pilihan <strong id="guestModalProductName" class="text-brand-espresso"></strong>, silakan masuk ke akun Anda atau daftarkan akun baru terlebih dahulu.
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

            <script>
                function openGuestAuthModal(productName) {
                    document.getElementById('guestModalProductName').textContent = productName ? '"' + productName + '"' : '';
                    document.getElementById('modalGuestAuth').classList.remove('hidden');
                }
            </script>

            </div>

        </div>
    </section>

@endsection

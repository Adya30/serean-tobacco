@extends('layouts.app')

@section('title', 'Profil Akun — Serean Tobacco')

@section('content')
    <div class="pt-28 pb-16 min-h-[80vh]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="p-6 sm:p-8 rounded-3xl bg-brand-dark text-white relative overflow-hidden shadow-xl">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-brand-gold/25 border border-brand-gold/40 flex items-center justify-center font-serif text-2xl font-bold text-brand-gold">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-brand-gold/20 text-brand-gold border border-brand-gold/30">
                                Pelanggan Resmi Serean
                            </span>
                            <h1 class="font-serif font-extrabold text-2xl sm:text-3xl text-white mt-1">{{ $user->name }}</h1>
                            <p class="text-xs sm:text-sm text-stone-300">{{ $user->email }}</p>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-full bg-white/10 hover:bg-red-500/30 text-white text-xs font-bold border border-white/20 transition-all cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-1.5"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

            @if (session('status'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-brand-border shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-brand-border pb-3">
                        <h2 class="font-serif font-bold text-lg text-brand-espresso">
                            Informasi Pribadi
                        </h2>
                        <button id="btnCustomerEdit" type="button" onclick="toggleCustomerProfile(true)" class="px-3.5 py-1.5 rounded-full border border-brand-border hover:border-brand-gold bg-brand-surface text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1.5 cursor-pointer shadow-xs">
                            <i class="fa-regular fa-pen-to-square text-[11px] text-brand-gold"></i>
                            <span>Ubah Profil</span>
                        </button>
                    </div>

                    <div id="customerProfileView" class="{{ ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('address')) ? 'hidden' : 'block' }} space-y-3.5 text-xs">
                        <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                            <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Nama Lengkap</span>
                            <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $user->name }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                            <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Alamat Email</span>
                            <span class="font-mono text-xs text-brand-espresso block">{{ $user->email }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                            <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Nomor WhatsApp / Telepon</span>
                            <span class="font-medium text-xs text-brand-espresso block">{{ $user->phone ?? 'Belum ditambahkan' }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                            <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Alamat Pengiriman Utama</span>
                            <span class="font-medium text-xs text-brand-espresso block leading-relaxed">{{ $user->address ?? 'Belum ada alamat pengiriman tercatat.' }}</span>
                        </div>
                    </div>

                    <div id="customerProfileEdit" class="{{ ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('address')) ? 'block' : 'hidden' }}">
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 text-xs">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block font-bold text-brand-espresso mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border focus:border-brand-gold focus:outline-none text-sm">
                                @error('name')
                                    <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-bold text-brand-espresso mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border focus:border-brand-gold focus:outline-none text-sm">
                                @error('email')
                                    <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-bold text-brand-espresso mb-1">Nomor WhatsApp</label>
                                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border focus:border-brand-gold focus:outline-none text-sm">
                                @error('phone')
                                    <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-bold text-brand-espresso mb-1">Alamat Pengiriman</label>
                                <textarea name="address" rows="3" placeholder="Alamat lengkap penerimaan tembakau" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border focus:border-brand-gold focus:outline-none text-sm">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center gap-2 pt-1">
                                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs hover:bg-brand-dark transition-colors cursor-pointer">
                                    Simpan Perubahan
                                </button>
                                <button type="button" onclick="toggleCustomerProfile(false)" class="px-4 py-2.5 rounded-xl border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer text-xs">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-brand-border shadow-sm space-y-4">
                    <h2 class="font-serif font-bold text-lg text-brand-espresso border-b border-brand-border pb-3">
                        Keamanan Kata Sandi
                    </h2>

                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-4 text-xs">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-bold text-brand-espresso mb-1">Kata Sandi Baru <span class="text-red-500">*</span></label>
                            <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border focus:border-brand-gold focus:outline-none text-sm">
                            @error('password')
                                <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-bold text-brand-espresso mb-1">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border focus:border-brand-gold focus:outline-none text-sm">
                        </div>

                        <button type="submit" class="w-full py-3 rounded-xl bg-brand-espresso text-white font-serif font-bold text-xs hover:bg-brand-dark transition-colors cursor-pointer">
                            Perbarui Sandi
                        </button>
                    </form>
                </div>
            </div>

            <script>
                function toggleCustomerProfile(showEdit) {
                    const viewEl = document.getElementById('customerProfileView');
                    const editEl = document.getElementById('customerProfileEdit');
                    const btn = document.getElementById('btnCustomerEdit');

                    if (showEdit) {
                        viewEl.classList.add('hidden');
                        viewEl.classList.remove('block');
                        editEl.classList.remove('hidden');
                        editEl.classList.add('block');
                        btn.classList.add('hidden');
                    } else {
                        editEl.classList.add('hidden');
                        editEl.classList.remove('block');
                        viewEl.classList.remove('hidden');
                        viewEl.classList.add('block');
                        btn.classList.remove('hidden');
                    }
                }
            </script>

        </div>
    </div>
@endsection

@extends('dashboard.layout')

@section('title', 'Profil Pengguna')
@section('page_title', 'Pengaturan Profil Akun')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-7 bg-white rounded-3xl border border-brand-border p-6 sm:p-8 shadow-sm space-y-5">
            <div class="flex items-start justify-between border-b border-brand-border pb-4 gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-[11px] font-semibold text-brand-gold uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-id-card text-[10px]"></i>
                        <span>Biodata Akun</span>
                    </span>
                    <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Informasi Profil</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Kelola informasi data pribadi dan kontak akun Anda.</p>
                </div>

                <button id="btnOpenEdit" type="button" onclick="toggleProfileEdit(true)" class="px-4 py-2 rounded-full border border-brand-border hover:border-brand-gold bg-brand-surface text-brand-espresso text-xs font-bold transition-all inline-flex items-center gap-1.5 cursor-pointer shadow-xs shrink-0">
                    <i class="fa-regular fa-pen-to-square text-[11px] text-brand-gold"></i>
                    <span>Ubah Profil</span>
                </button>
            </div>

            <div id="profileViewMode" class="{{ ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('address')) ? 'hidden' : 'block' }} space-y-4 text-xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                        <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Nama Lengkap</span>
                        <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $user->name }}</span>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                        <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Alamat Email</span>
                        <span class="font-mono text-xs text-brand-espresso block">{{ $user->email }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                        <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Nomor WhatsApp / Telepon</span>
                        <span class="font-medium text-xs text-brand-espresso block">{{ $user->phone ?? 'Belum ditambahkan' }}</span>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                        <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Peran Akun</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-brand-gold border border-brand-gold/30">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                @if ($user->isPetani())
                    <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                        <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Wilayah Kebun / Ladang</span>
                        <span class="font-medium text-xs text-brand-espresso block">{{ $user->farm_location ?? 'Situbondo, Jawa Timur' }}</span>
                    </div>
                @endif

                <div class="p-3.5 rounded-2xl bg-brand-surface border border-brand-border">
                    <span class="text-[10px] text-brand-muted uppercase font-bold block mb-1">Alamat Lengkap</span>
                    <span class="font-medium text-xs text-brand-espresso block leading-relaxed">{{ $user->address ?? 'Belum ada data alamat lengkap.' }}</span>
                </div>
            </div>

            <div id="profileEditMode" class="{{ ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('address')) ? 'block' : 'hidden' }}">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                        @error('name')
                            <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                        @error('email')
                            <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1.5">Nomor WhatsApp / Telepon</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                        @error('phone')
                            <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($user->isPetani())
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1.5">Wilayah Kebun / Ladang</label>
                            <input type="text" name="farm_location" value="{{ old('farm_location', $user->farm_location) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                            @error('farm_location')
                                <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1.5">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-2 flex items-center gap-2.5">
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white font-semibold hover:bg-brand-dark transition-all cursor-pointer shadow-sm">
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="toggleProfileEdit(false)" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors text-xs">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-5 bg-white rounded-3xl border border-brand-border p-6 sm:p-8 shadow-sm space-y-5">
            <div class="border-b border-brand-border pb-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-[11px] font-semibold text-brand-gold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-lock text-[10px]"></i>
                    <span>Keamanan</span>
                </span>
                <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Ubah Kata Sandi</h3>
                <p class="text-xs text-brand-muted mt-0.5">Langsung masukkan kata sandi baru untuk mengamankan akun.</p>
            </div>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Kata Sandi Baru <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    @error('password')
                        <span class="text-red-600 text-[11px] mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Konfirmasi Sandi Baru <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white font-semibold hover:bg-brand-dark transition-all cursor-pointer shadow-sm">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleProfileEdit(showEdit) {
            const viewMode = document.getElementById('profileViewMode');
            const editMode = document.getElementById('profileEditMode');
            const btnOpenEdit = document.getElementById('btnOpenEdit');

            if (showEdit) {
                viewMode.classList.add('hidden');
                viewMode.classList.remove('block');
                editMode.classList.remove('hidden');
                editMode.classList.add('block');
                btnOpenEdit.classList.add('hidden');
            } else {
                editMode.classList.add('hidden');
                editMode.classList.remove('block');
                viewMode.classList.remove('hidden');
                viewMode.classList.add('block');
                btnOpenEdit.classList.remove('hidden');
            }
        }
    </script>

@endsection

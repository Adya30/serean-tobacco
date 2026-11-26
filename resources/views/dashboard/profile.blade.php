@extends('dashboard.layout')

@section('title', 'Profil Pengguna')
@section('page_title', 'Pengaturan Profil Akun')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-7 bg-white rounded-3xl border border-brand-border p-6 sm:p-8 shadow-sm space-y-5">
            <div class="border-b border-brand-border pb-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-[11px] font-semibold text-brand-gold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-id-card text-[10px]"></i>
                    <span>Biodata Akun</span>
                </span>
                <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Informasi Profil</h3>
                <p class="text-xs text-brand-muted mt-0.5">Perbarui informasi profil dan data kontak akun Anda.</p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Nomor WhatsApp / Telepon</label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                @if ($user->isPetani())
                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1.5">Wilayah Kebun / Ladang</label>
                        <input type="text" name="farm_location" value="{{ old('farm_location', $user->farm_location) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                @endif

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Alamat Lengkap</label>
                    <textarea name="address" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white font-semibold hover:bg-brand-dark transition-all cursor-pointer shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-5 bg-white rounded-3xl border border-brand-border p-6 sm:p-8 shadow-sm space-y-5">
            <div class="border-b border-brand-border pb-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-[11px] font-semibold text-brand-gold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-lock text-[10px]"></i>
                    <span>Keamanan</span>
                </span>
                <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Ubah Kata Sandi</h3>
                <p class="text-xs text-brand-muted mt-0.5">Pastikan kata sandi Anda kuat untuk keamanan akun.</p>
            </div>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Kata Sandi Baru</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1.5">Konfirmasi Sandi Baru</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white font-semibold hover:bg-brand-dark transition-all cursor-pointer shadow-sm">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

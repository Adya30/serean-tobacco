@extends('dashboard.layout')

@section('title', 'Dashboard ' . (Auth::user()->isAdmin() ? 'Administrator' : 'Petani Mitra'))
@section('page_title', 'Ringkasan Kemitraan Tembakau')

@section('content')

    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-brand-dark via-brand-espresso to-[#2b170c] text-white shadow-md relative overflow-hidden border border-brand-gold/20">
        <div class="absolute -right-8 -bottom-10 opacity-10 pointer-events-none select-none">
            <i class="fa-solid fa-leaf text-[200px]"></i>
        </div>
        <div class="relative z-10 max-w-2xl">
            <h2 class="font-serif font-extrabold text-2xl sm:text-3xl text-white tracking-tight leading-snug">
                Selamat Datang, {{ Auth::user()->name }}
            </h2>
            <p class="text-stone-300 text-xs sm:text-sm mt-1.5 leading-relaxed">
                Kelola distribusi panen, pantau varietas tembakau rajangan, dan registrasikan mitra petani resmi di sentra Serean Tobacco.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="p-5 sm:p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs sm:text-sm font-medium text-brand-muted">Petani Mitra</p>
                <p class="text-2xl sm:text-3xl font-bold text-brand-espresso mt-1 tracking-tight">{{ $stats['total_petani'] }} <span class="text-sm font-normal text-brand-muted">Orang</span></p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

        <div class="p-5 sm:p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs sm:text-sm font-medium text-brand-muted">Varietas Aktif</p>
                <p class="text-2xl sm:text-3xl font-bold text-brand-espresso mt-1 tracking-tight">{{ $stats['varietas_aktif'] }}+ <span class="text-sm font-normal text-brand-muted">Jenis</span></p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                <i class="fa-solid fa-leaf"></i>
            </div>
        </div>

        <div class="p-5 sm:p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs sm:text-sm font-medium text-brand-muted">Stok Rajangan</p>
                <p class="text-2xl sm:text-3xl font-bold text-brand-espresso mt-1 tracking-tight">{{ number_format($stats['stok_tembakau_kg']) }} <span class="text-sm font-normal text-brand-muted">Kg</span></p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="p-5 sm:p-6 rounded-3xl bg-white border border-brand-border shadow-sm hover:border-brand-gold hover:shadow-md transition-all duration-300 flex items-center justify-between group">
            <div>
                <p class="text-xs sm:text-sm font-medium text-brand-muted">Kadar Air Curing</p>
                <p class="text-2xl sm:text-3xl font-bold text-brand-espresso mt-1 tracking-tight">{{ $stats['kadar_air_rata'] }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-brand-gold/25 text-brand-gold flex items-center justify-center text-lg group-hover:bg-brand-espresso group-hover:text-brand-gold transition-colors shadow-sm">
                <i class="fa-solid fa-droplet"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
        <div class="p-5 sm:p-7 border-b border-brand-border flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-surface border border-brand-border text-[11px] font-semibold text-brand-gold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-users text-[10px]"></i>
                    <span>Kemitraan Petani</span>
                </span>
                <h3 class="font-serif font-extrabold text-xl sm:text-2xl text-[#1a0f07] tracking-tight">
                    Daftar Akun Login Petani Mitra
                </h3>
                <p class="text-xs sm:text-sm text-brand-muted mt-1 leading-relaxed">
                    @if (Auth::user()->isAdmin())
                        Kelola dan registrasikan akun login untuk mitra petani tembakau binaan Serean Tobacco.
                    @else
                        Daftar mitra petani terverifikasi di sentra pengolahan tembakau Nusantara.
                    @endif
                </p>
            </div>

            @if (Auth::user()->isAdmin())
                <button onclick="document.getElementById('modalTambahPetani').classList.remove('hidden')" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all inline-flex items-center gap-2 shadow-sm shrink-0 cursor-pointer">
                    <i class="fa-solid fa-user-plus text-brand-gold text-xs"></i>
                    <span>Daftarkan Petani Baru</span>
                </button>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-5 sm:px-6">Nama Petani</th>
                        <th class="py-3.5 px-5 sm:px-6">Email Login</th>
                        <th class="py-3.5 px-5 sm:px-6">Wilayah / Kebun</th>
                        <th class="py-3.5 px-5 sm:px-6">Kontak WhatsApp</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center">Status</th>
                        @if (Auth::user()->isAdmin())
                            <th class="py-3.5 px-5 sm:px-6 text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border">
                    @forelse ($petanis as $petani)
                        <tr class="hover:bg-brand-surface/60 transition-colors">
                            <td class="py-4 px-5 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-amber-50 border border-brand-gold/30 text-brand-gold font-bold flex items-center justify-center font-serif text-xs shrink-0 shadow-sm">
                                        {{ strtoupper(substr($petani->name, 0, 2)) }}
                                    </div>
                                    <span class="font-serif font-bold text-sm text-brand-espresso">{{ $petani->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-brand-muted font-mono text-[11px]">{{ $petani->email }}</td>
                            <td class="py-4 px-5 sm:px-6 text-brand-muted text-xs">{{ $petani->farm_location ?? 'Situbondo, Jawa Timur' }}</td>
                            <td class="py-4 px-5 sm:px-6">
                                @if ($petani->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $petani->phone) }}" target="_blank" class="text-emerald-700 font-semibold hover:underline inline-flex items-center gap-1.5">
                                        <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                        <span>{{ $petani->phone }}</span>
                                    </a>
                                @else
                                    <span class="text-stone-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Aktif
                                </span>
                            </td>
                            @if (Auth::user()->isAdmin())
                                <td class="py-4 px-5 sm:px-6 text-right">
                                    <form action="{{ route('dashboard.petani.delete', $petani->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun petani ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full border border-brand-border hover:border-red-300 hover:bg-red-50 text-stone-400 hover:text-red-600 transition-colors inline-flex items-center justify-center cursor-pointer" title="Hapus Petani">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}" class="py-12 text-center text-brand-muted text-xs">
                                <i class="fa-solid fa-users text-2xl text-stone-300 mb-2 block"></i>
                                Belum ada akun petani mitra yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (Auth::user()->isAdmin())
        <div id="modalTambahPetani" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Daftarkan Akun Petani Mitra</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Petani dapat langsung login menggunakan email &amp; sandi ini.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalTambahPetani').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form action="{{ route('dashboard.petani.store') }}" method="POST" class="space-y-4 pt-5 text-xs">
                    @csrf

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nama Lengkap Petani <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Pak Slamet" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Email Login <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required placeholder="petani@sereantobacco.com" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kata Sandi Awal <span class="text-red-500">*</span></label>
                            <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Nomor WhatsApp</label>
                            <input type="tel" name="phone" placeholder="081234567890" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Wilayah / Nama Ladang</label>
                            <input type="text" name="farm_location" placeholder="Kalisari Blok A, Situbondo" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Alamat Tinggal</label>
                        <textarea name="address" rows="2" placeholder="Desa Kalisari, Banyuglugur" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalTambahPetani').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-full bg-brand-espresso text-white hover:bg-brand-dark font-semibold shadow-sm cursor-pointer transition-colors">
                            Daftarkan Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

@endsection

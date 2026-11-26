@extends('layouts.dashboard')

@section('title', 'Manajemen Petani — Serean Tobacco')
@section('page_title', 'Kelola Akun Petani')

@section('content')

    @if (Auth::user()->isAdmin())
        <div class="flex justify-end">
            <button onclick="document.getElementById('modalTambahPetani').classList.remove('hidden')" class="px-5 py-2.5 rounded-full bg-brand-espresso text-white text-xs font-semibold hover:bg-brand-dark transition-all inline-flex items-center gap-2 shadow-sm shrink-0 cursor-pointer">
                <i class="fa-solid fa-user-plus text-brand-gold text-xs"></i>
                <span>Daftarkan Petani Baru</span>
            </button>
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
        <div class="block sm:hidden divide-y divide-brand-border">
            @forelse ($petanis as $petani)
                <div class="p-4 space-y-2.5">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-amber-50 border border-brand-gold/30 text-brand-gold font-bold flex items-center justify-center font-serif text-xs shrink-0 shadow-sm">
                                {{ strtoupper(substr($petani->name, 0, 2)) }}
                            </div>
                            <div>
                                <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $petani->name }}</span>
                                <span class="text-[11px] text-brand-muted font-mono block">{{ $petani->email }}</span>
                            </div>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                            Aktif
                        </span>
                    </div>

                    <div class="text-xs text-brand-muted pt-1 border-t border-brand-border/60 space-y-1">
                        <div>
                            <span class="text-[10px] uppercase text-stone-400 block font-semibold">Ladang / Wilayah</span>
                            <span class="text-stone-700">{{ $petani->farm_location ?? 'Situbondo, Jawa Timur' }}</span>
                        </div>
                        @if ($petani->phone)
                            <div class="pt-0.5">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $petani->phone) }}" target="_blank" class="text-emerald-700 font-semibold hover:underline inline-flex items-center gap-1.5">
                                    <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                    <span>{{ $petani->phone }}</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    @if (Auth::user()->isAdmin())
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-brand-border/60">
                            <button type="button" onclick="openEditPetaniModal({{ json_encode($petani) }})" class="px-3 py-1.5 rounded-full border border-brand-border hover:border-brand-gold bg-brand-surface text-brand-espresso text-xs font-semibold transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-regular fa-pen-to-square text-[10px] text-brand-gold"></i>
                                <span>Ubah Data</span>
                            </button>
                            <form action="{{ route('dashboard.petani.delete', $petani->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun petani ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-full border border-red-200 hover:bg-red-50 text-red-600 text-xs font-semibold transition-colors inline-flex items-center gap-1.5 cursor-pointer">
                                    <i class="fa-regular fa-trash-can text-[10px]"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-brand-muted text-xs">
                    Belum ada akun petani mitra terdaftar.
                </div>
            @endforelse
        </div>

        <div class="hidden sm:block overflow-x-auto no-scrollbar">
            <table class="w-full text-left text-xs min-w-[650px]">
                <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-5 sm:px-6">Nama Petani</th>
                        <th class="py-3.5 px-5 sm:px-6">Email Login</th>
                        <th class="py-3.5 px-5 sm:px-6">Wilayah / Nama Ladang</th>
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
                                <td class="py-4 px-5 sm:px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button type="button" onclick="openEditPetaniModal({{ json_encode($petani) }})" class="w-8 h-8 rounded-full border border-brand-border hover:border-brand-gold hover:bg-amber-50 text-stone-500 hover:text-brand-espresso transition-colors inline-flex items-center justify-center cursor-pointer" title="Ubah Data Petani">
                                            <i class="fa-regular fa-pen-to-square text-xs text-brand-gold"></i>
                                        </button>
                                        <form action="{{ route('dashboard.petani.delete', $petani->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun petani ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-full border border-brand-border hover:border-red-300 hover:bg-red-50 text-stone-400 hover:text-red-600 transition-colors inline-flex items-center justify-center cursor-pointer" title="Hapus Petani">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}" class="py-12 text-center text-brand-muted text-xs">
                                Belum ada akun petani terdaftar.
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
        <div id="modalTambahPetani" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Daftarkan Akun Petani</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Petani dapat langsung login menggunakan email &amp; sandi ini.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalTambahPetani').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
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

        <div id="modalEditPetani" class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden no-scrollbar overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border relative max-h-[90vh] overflow-y-auto no-scrollbar">
                <div class="flex items-center justify-between pb-4 border-b border-brand-border">
                    <div>
                        <h3 class="font-serif font-extrabold text-xl text-[#1a0f07] tracking-tight">Ubah Data Petani</h3>
                        <p class="text-xs text-brand-muted mt-0.5">Perbarui informasi profil atau perbarui kata sandi akun petani.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('modalEditPetani').classList.add('hidden')" class="w-8 h-8 rounded-full border border-brand-border text-stone-400 hover:text-brand-dark hover:bg-brand-surface flex items-center justify-center transition-colors cursor-pointer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <form id="formEditPetani" method="POST" class="space-y-4 pt-5 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Nama Lengkap Petani <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_petani_name" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Email Login <span class="text-red-500">*</span></label>
                            <input type="email" id="edit_petani_email" name="email" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Kata Sandi Baru (Opsional)</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tetap" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Nomor WhatsApp</label>
                            <input type="tel" id="edit_petani_phone" name="phone" placeholder="08..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block font-semibold text-brand-espresso mb-1">Wilayah / Nama Ladang</label>
                            <input type="text" id="edit_petani_farm_location" name="farm_location" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Alamat Tinggal</label>
                        <textarea id="edit_petani_address" name="address" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:outline-none focus:border-brand-gold text-sm transition-colors"></textarea>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2.5">
                        <button type="button" onclick="document.getElementById('modalEditPetani').classList.add('hidden')" class="px-5 py-2.5 rounded-full border border-brand-border text-brand-muted hover:bg-stone-50 font-semibold cursor-pointer transition-colors">
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
            function openEditPetaniModal(petani) {
                document.getElementById('formEditPetani').action = '/dashboard/petani/' + petani.id;
                document.getElementById('edit_petani_name').value = petani.name || '';
                document.getElementById('edit_petani_email').value = petani.email || '';
                document.getElementById('edit_petani_phone').value = petani.phone || '';
                document.getElementById('edit_petani_farm_location').value = petani.farm_location || '';
                document.getElementById('edit_petani_address').value = petani.address || '';
                document.getElementById('modalEditPetani').classList.remove('hidden');
            }
        </script>
    @endif
@endpush

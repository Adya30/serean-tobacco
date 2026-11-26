@extends('layouts.dashboard')

@section('title', 'Jadwal Penanam Tembakau — Serean Tobacco')
@section('page_title', 'Jadwal Penanam Tembakau')

@section('content')

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs text-brand-muted">
                {{ Auth::user()->isPetani() ? 'Kelola jadwal pembibitan, penanaman, fase pemeliharaan, hingga target panen tembakau di ladang Anda.' : 'Monitor jadwal penanaman dan estimasi panen seluruh petani sentra.' }}
            </p>
        </div>
        <button onclick="openModalTambahJadwal()" type="button" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-gold hover:bg-brand-goldHover text-white text-xs font-bold transition-all shadow-sm cursor-pointer shrink-0">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Buat Jadwal Tanam Baru</span>
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Jadwal Tanam Aktif</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ $totalJadwalAktif }} Jadwal</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Total Luas Lahan</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ number_format($totalLuasHa, 2) }} Ha</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Target Hasil Panen</span>
                <span class="font-serif font-extrabold text-2xl text-brand-espresso mt-1 block">{{ number_format($totalTargetKg) }} Kg</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                <i class="fa-solid fa-wheat-awn"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Menjelang Panen (&le;14 Hari)</span>
                <span class="font-serif font-extrabold text-2xl text-amber-700 mt-1 block">{{ $jadwalPanenDekat }} Jadwal</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
        <div class="block lg:hidden divide-y divide-brand-border">
            @forelse ($schedules as $j)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $j->variety }}</span>
                            <span class="text-[11px] text-brand-muted block mt-0.5">{{ $j->farmer_name }} • {{ $j->location }}</span>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $j->phaseBadge() }} whitespace-nowrap shrink-0">
                            {{ $j->phaseLabel() }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs pt-1 border-t border-brand-border/60">
                        <div>
                            <span class="text-[10px] text-brand-muted block">Mulai Tanam</span>
                            <span class="font-semibold text-stone-700">{{ date('d M Y', strtotime($j->planting_date)) }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-brand-muted block">Estimasi Panen</span>
                            <span class="font-semibold text-brand-espresso">{{ date('d M Y', strtotime($j->estimated_harvest_date)) }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-brand-muted block">Luas Lahan</span>
                            <span class="font-bold text-stone-800">{{ $j->land_area_ha }} Ha</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-brand-muted block">Target Hasil</span>
                            <span class="font-bold text-emerald-700">{{ number_format($j->target_yield_kg) }} Kg</span>
                        </div>
                    </div>

                    @php
                        $daysLeft = $j->daysToHarvest();
                    @endphp
                    <div class="flex items-center justify-between text-xs pt-1">
                        <div>
                            @if ($j->phase === 'selesai')
                                <span class="text-[11px] font-semibold text-stone-500">Panen Selesai</span>
                            @elseif ($daysLeft < 0)
                                <span class="text-[11px] font-bold text-red-600">Melewati Estimasi Panen</span>
                            @elseif ($daysLeft === 0)
                                <span class="text-[11px] font-bold text-emerald-600">Siap Panen Hari Ini!</span>
                            @else
                                <span class="text-[11px] font-bold text-amber-700">{{ $daysLeft }} Hari Menuju Panen</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" onclick="openModalEditJadwal({{ json_encode($j) }})" class="px-3 py-1 rounded-lg border border-brand-border bg-brand-surface hover:bg-stone-100 text-brand-espresso text-xs font-bold transition-colors cursor-pointer">
                                <i class="fa-regular fa-pen-to-square text-[11px] mr-1"></i> Ubah
                            </button>
                            <form action="{{ route('dashboard.jadwal.delete', $j->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal tanam ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-stone-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors cursor-pointer">
                                    <i class="fa-regular fa-trash-can text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if ($j->notes)
                        <p class="text-[11px] text-stone-500 italic bg-brand-surface p-2 rounded-xl border border-brand-border/60">
                            "{{ $j->notes }}"
                        </p>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-brand-muted text-xs">
                    Belum ada data jadwal penanaman. Tekan tombol "Buat Jadwal Tanam Baru" untuk memulai.
                </div>
            @endforelse
        </div>

        <div class="hidden lg:block overflow-x-auto no-scrollbar">
            <table class="w-full text-left text-xs min-w-[800px]">
                <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-5 sm:px-6">Varietas &amp; Petani</th>
                        <th class="py-3.5 px-5 sm:px-6">Lokasi &amp; Luas Lahan</th>
                        <th class="py-3.5 px-5 sm:px-6">Tanggal Tanam</th>
                        <th class="py-3.5 px-5 sm:px-6">Estimasi Panen</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center">Target Tonase</th>
                        <th class="py-3.5 px-5 sm:px-6 text-center">Fase Budidaya</th>
                        <th class="py-3.5 px-5 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border">
                    @forelse ($schedules as $j)
                        <tr class="hover:bg-brand-surface/60 transition-colors">
                            <td class="py-4 px-5 sm:px-6">
                                <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $j->variety }}</span>
                                <span class="text-[11px] text-brand-muted block mt-0.5">{{ $j->farmer_name }}</span>
                                @if ($j->notes)
                                    <span class="text-[10px] text-stone-400 italic block mt-0.5">{{ Str::limit($j->notes, 40) }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-5 sm:px-6">
                                <span class="font-medium text-stone-800 block">{{ $j->location }}</span>
                                <span class="text-[11px] text-brand-gold font-bold">{{ $j->land_area_ha }} Hektar</span>
                            </td>
                            <td class="py-4 px-5 sm:px-6 whitespace-nowrap">
                                <span class="font-medium text-stone-700">{{ date('d M Y', strtotime($j->planting_date)) }}</span>
                            </td>
                            <td class="py-4 px-5 sm:px-6 whitespace-nowrap">
                                <div>
                                    <span class="font-bold text-brand-espresso block">{{ date('d M Y', strtotime($j->estimated_harvest_date)) }}</span>
                                    @php
                                        $dLeft = $j->daysToHarvest();
                                    @endphp
                                    @if ($j->phase === 'selesai')
                                        <span class="text-[10px] text-stone-400 font-medium">Panen selesai</span>
                                    @elseif ($dLeft < 0)
                                        <span class="text-[10px] text-red-600 font-bold">Terlewat</span>
                                    @elseif ($dLeft === 0)
                                        <span class="text-[10px] text-emerald-600 font-bold">Hari ini</span>
                                    @else
                                        <span class="text-[10px] text-amber-700 font-semibold">{{ $dLeft }} hari lagi</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-center font-serif font-bold text-sm text-emerald-700 whitespace-nowrap">
                                {{ number_format($j->target_yield_kg) }} Kg
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-center whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $j->phaseBadge() }}">
                                    {{ $j->phaseLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-5 sm:px-6 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <button type="button" onclick="openModalEditJadwal({{ json_encode($j) }})" class="px-3 py-1.5 rounded-lg border border-brand-border bg-brand-surface hover:bg-stone-100 text-brand-espresso text-xs font-bold transition-colors cursor-pointer inline-flex items-center gap-1">
                                        <i class="fa-regular fa-pen-to-square text-[11px]"></i>
                                        <span>Ubah</span>
                                    </button>
                                    <form action="{{ route('dashboard.jadwal.delete', $j->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal tanam ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-stone-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors cursor-pointer" title="Hapus Jadwal">
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-brand-muted text-xs">
                                Belum ada data jadwal penanaman. Tekan tombol "Buat Jadwal Tanam Baru" untuk mulai mencatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('modals')
    <div id="modalTambahJadwal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs hidden transition-opacity duration-300">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border space-y-5 max-h-[90vh] overflow-y-auto no-scrollbar">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso">Buat Jadwal Tanam Baru</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Rencanakan musim tanam tembakau untuk monitoring dan estimasi panen.</p>
                </div>
                <button type="button" onclick="closeModalTambahJadwal()" class="w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 flex items-center justify-center transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('dashboard.jadwal.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Varietas Tembakau <span class="text-red-500">*</span></label>
                    <select name="variety" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors cursor-pointer">
                        <option value="">Pilih Varietas Tembakau</option>
                        <option value="Tembakau Opot (Besuki Na-Oogst)">Tembakau Opot (Besuki Na-Oogst)</option>
                        <option value="Tembakau Samporis">Tembakau Samporis</option>
                        <option value="Tembakau Marakot">Tembakau Marakot</option>
                        <option value="Tembakau Baleno">Tembakau Baleno</option>
                        <option value="Tembakau Virginia Voor-Oogst">Tembakau Virginia Voor-Oogst</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Luas Lahan (Ha) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0.01" name="land_area_ha" value="0.5" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Target Panen (Kg) <span class="text-red-500">*</span></label>
                        <input type="number" min="1" name="target_yield_kg" value="500" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Lokasi Lahan / Kebun <span class="text-red-500">*</span></label>
                    <input type="text" name="location" value="{{ Auth::user()->farm_location ?? 'Lahan Kebun Krajan' }}" required placeholder="Contoh: Blok Barat, Besuki" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Tanggal Mulai Tanam / Semai <span class="text-red-500">*</span></label>
                        <input type="date" name="planting_date" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Estimasi Tanggal Panen <span class="text-red-500">*</span></label>
                        <input type="date" name="estimated_harvest_date" value="{{ date('Y-m-d', strtotime('+75 days')) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Fase Awal Saat Ini <span class="text-red-500">*</span></label>
                    <select name="phase" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors cursor-pointer">
                        <option value="persemaian">Persemaian Bibit</option>
                        <option value="penanaman">Penanaman Lahan (Transplanting)</option>
                        <option value="pemeliharaan">Pemeliharaan &amp; Bumbun</option>
                        <option value="siap_panen">Siap Panen</option>
                        <option value="selesai">Selesai Panen</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Catatan Khusus / Perawatan</label>
                    <textarea name="notes" rows="2" placeholder="Catatan perlakuan pupuk dasar, naungan bibit, atau rotasi guludan..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-brand-border">
                    <button type="button" onclick="closeModalTambahJadwal()" class="px-5 py-2.5 rounded-xl border border-brand-border hover:bg-stone-100 text-stone-600 font-bold transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-gold hover:bg-brand-goldHover text-white font-bold transition-all shadow-md cursor-pointer">
                        Simpan Jadwal Tanam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEditJadwal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs hidden transition-opacity duration-300">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border space-y-5 max-h-[90vh] overflow-y-auto no-scrollbar">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso">Ubah Data Jadwal Tanam</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Perbarui fase perkembangan tanaman, estimasi panen, atau catatan.</p>
                </div>
                <button type="button" onclick="closeModalEditJadwal()" class="w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 flex items-center justify-center transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form id="formEditJadwal" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Varietas Tembakau <span class="text-red-500">*</span></label>
                    <select id="edit_variety" name="variety" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors cursor-pointer">
                        <option value="Tembakau Opot (Besuki Na-Oogst)">Tembakau Opot (Besuki Na-Oogst)</option>
                        <option value="Tembakau Samporis">Tembakau Samporis</option>
                        <option value="Tembakau Marakot">Tembakau Marakot</option>
                        <option value="Tembakau Baleno">Tembakau Baleno</option>
                        <option value="Tembakau Virginia Voor-Oogst">Tembakau Virginia Voor-Oogst</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Luas Lahan (Ha) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0.01" id="edit_land_area_ha" name="land_area_ha" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Target Panen (Kg) <span class="text-red-500">*</span></label>
                        <input type="number" min="1" id="edit_target_yield_kg" name="target_yield_kg" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Lokasi Kebun / Lahan <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_location" name="location" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Tanggal Mulai Tanam <span class="text-red-500">*</span></label>
                        <input type="date" id="edit_planting_date" name="planting_date" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Estimasi Tanggal Panen <span class="text-red-500">*</span></label>
                        <input type="date" id="edit_estimated_harvest_date" name="estimated_harvest_date" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Fase Perkembangan Tanaman <span class="text-red-500">*</span></label>
                    <select id="edit_phase" name="phase" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors cursor-pointer">
                        <option value="persemaian">Persemaian Bibit</option>
                        <option value="penanaman">Penanaman Lahan (Transplanting)</option>
                        <option value="pemeliharaan">Pemeliharaan &amp; Bumbun</option>
                        <option value="siap_panen">Siap Panen</option>
                        <option value="selesai">Selesai Panen</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Catatan Khusus / Perawatan</label>
                    <textarea id="edit_notes" name="notes" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-brand-border">
                    <button type="button" onclick="closeModalEditJadwal()" class="px-5 py-2.5 rounded-xl border border-brand-border hover:bg-stone-100 text-stone-600 font-bold transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-gold hover:bg-brand-goldHover text-white font-bold transition-all shadow-md cursor-pointer">
                        Perbarui Jadwal Tanam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalTambahJadwal() {
            document.getElementById('modalTambahJadwal').classList.remove('hidden');
        }

        function closeModalTambahJadwal() {
            document.getElementById('modalTambahJadwal').classList.add('hidden');
        }

        function openModalEditJadwal(j) {
            document.getElementById('formEditJadwal').action = '/dashboard/jadwal-tanam/' + j.id;
            document.getElementById('edit_variety').value = j.variety;
            document.getElementById('edit_land_area_ha').value = j.land_area_ha;
            document.getElementById('edit_target_yield_kg').value = j.target_yield_kg;
            document.getElementById('edit_location').value = j.location;
            document.getElementById('edit_planting_date').value = j.planting_date ? j.planting_date.substring(0, 10) : '';
            document.getElementById('edit_estimated_harvest_date').value = j.estimated_harvest_date ? j.estimated_harvest_date.substring(0, 10) : '';
            document.getElementById('edit_phase').value = j.phase;
            document.getElementById('edit_notes').value = j.notes || '';
            document.getElementById('modalEditJadwal').classList.remove('hidden');
        }

        function closeModalEditJadwal() {
            document.getElementById('modalEditJadwal').classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModalTambahJadwal();
                closeModalEditJadwal();
            }
        });
    </script>
@endpush

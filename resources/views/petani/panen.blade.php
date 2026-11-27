@extends('layouts.dashboard')

@section('title', 'Hasil Panen Petani — Serean Tobacco')
@section('page_title', 'Hasil Panen Petani')

@section('content')

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs text-brand-muted">
                {{ Auth::user()->isPetani() ? 'Catat dan pantau seluruh setoran hasil panen tembakau dari kebun Anda ke sentra.' : 'Data akumulasi setoran panen tembakau dari seluruh petani ke gudang sentra.' }}
            </p>
        </div>
        <button onclick="openModalTambahPanen()" type="button" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-gold hover:bg-brand-goldHover text-white text-xs font-bold transition-all shadow-sm cursor-pointer shrink-0">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Catat Hasil Panen Baru</span>
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Total Akumulasi Panen</span>
                <span class="font-serif font-extrabold text-lg sm:text-xl text-brand-espresso mt-1 block">{{ number_format($totalPanenKg) }} Kg</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                <i class="fa-solid fa-wheat-awn"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Setoran Panen Tercatat</span>
                <span class="font-serif font-extrabold text-lg sm:text-xl text-brand-espresso mt-1 block">{{ $harvests->count() }} Data</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs text-brand-muted block font-medium">Dominan Rajangan</span>
                <span class="font-serif font-extrabold text-lg sm:text-xl text-brand-espresso mt-1 block">Rajang Halus</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-brand-gold flex items-center justify-center text-base">
                <i class="fa-solid fa-scissors"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-brand-border shadow-sm overflow-hidden">
        <div class="block sm:hidden divide-y divide-brand-border">
            @forelse ($harvests as $h)
                <div class="p-4 space-y-2.5">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <span class="font-serif font-bold text-sm text-brand-espresso block">{{ $h->variety }}</span>
                            <span class="text-[11px] text-brand-muted block mt-0.5">{{ $h->farmer_name }} • {{ date('d M Y', strtotime($h->harvest_date)) }}</span>
                        </div>
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 border border-brand-gold/35 text-brand-espresso whitespace-nowrap shrink-0">
                            {{ $h->grade }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs pt-1 border-t border-brand-border/60">
                        <div>
                            <span class="text-[10px] text-brand-muted block">Berat Panen</span>
                            <span class="font-serif font-bold text-sm text-emerald-700">
                                {{ number_format($h->harvest_weight_kg) }} Kg
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] text-brand-muted block">Jenis Rajangan</span>
                            <span class="text-xs font-medium text-stone-700">
                                {{ $h->moisture_content }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-[11px] pt-1">
                        <span class="text-stone-500 truncate max-w-[170px]">{{ $h->farm_location }}</span>
                        @php
                            $badge = match($h->status) {
                                'siap_distribusi' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'proses_curing' => 'bg-amber-50 text-amber-700 border-amber-200',
                                default => 'bg-blue-50 text-blue-700 border-blue-200'
                            };
                            $label = match($h->status) {
                                'siap_distribusi' => 'Siap Distribusi',
                                'proses_curing' => 'Proses Curing',
                                default => 'Diterima Gudang'
                            };
                        @endphp
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badge }}">
                            {{ $label }}
                        </span>
                    </div>

                    @if ($h->quality_notes)
                        <p class="text-[11px] text-stone-500 italic bg-brand-surface p-2 rounded-xl border border-brand-border/60">
                            "{{ $h->quality_notes }}"
                        </p>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-brand-muted text-xs">
                    Belum ada data hasil panen yang masuk.
                </div>
            @endforelse
        </div>

        <div class="hidden sm:block overflow-x-auto no-scrollbar">
            <table class="w-full text-left text-xs">
                <thead class="bg-brand-surface border-b border-brand-border text-brand-muted font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3 px-3 sm:px-4 whitespace-nowrap">Tanggal &amp; Petani</th>
                        <th class="py-3 px-3 sm:px-4">Varietas Tembakau</th>
                        <th class="py-3 px-3 sm:px-4 whitespace-nowrap">Grade</th>
                        <th class="py-3 px-3 sm:px-4 text-center whitespace-nowrap">Berat Panen</th>
                        <th class="py-3 px-3 sm:px-4 text-center whitespace-nowrap">Jenis Rajangan</th>
                        <th class="py-3 px-3 sm:px-4">Lokasi Ladang / Kebun</th>
                        <th class="py-3 px-3 sm:px-4 text-center whitespace-nowrap">Status Sentra</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-border">
                    @forelse ($harvests as $h)
                        <tr class="hover:bg-brand-surface/60 transition-colors">
                            <td class="py-3.5 px-3 sm:px-4 whitespace-nowrap">
                                <div>
                                    <span class="font-bold text-brand-espresso text-xs block">{{ $h->farmer_name }}</span>
                                    <span class="text-[11px] text-brand-muted">{{ date('d M Y', strtotime($h->harvest_date)) }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-3 sm:px-4 font-serif font-bold text-sm text-brand-espresso">
                                {{ $h->variety }}
                            </td>
                            <td class="py-3.5 px-3 sm:px-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50/90 border border-brand-gold/35 text-brand-espresso whitespace-nowrap shadow-2xs">
                                    {{ $h->grade }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 sm:px-4 text-center font-serif font-bold text-sm text-emerald-700 whitespace-nowrap">
                                {{ number_format($h->harvest_weight_kg) }} Kg
                            </td>
                            <td class="py-3.5 px-3 sm:px-4 text-center font-mono text-stone-600 whitespace-nowrap">
                                {{ $h->moisture_content }}
                            </td>
                            <td class="py-3.5 px-3 sm:px-4 text-stone-600">
                                {{ $h->farm_location }}
                                @if ($h->quality_notes)
                                    <span class="block text-[11px] text-stone-400 mt-0.5 italic">{{ $h->quality_notes }}</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 sm:px-4 text-center whitespace-nowrap">
                                @php
                                    $badge = match($h->status) {
                                        'siap_distribusi' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'proses_curing' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        default => 'bg-blue-50 text-blue-700 border-blue-200'
                                    };
                                    $label = match($h->status) {
                                        'siap_distribusi' => 'Siap Distribusi',
                                        'proses_curing' => 'Proses Curing',
                                        default => 'Diterima Gudang'
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $badge }}">
                                    {{ $label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-brand-muted text-xs">
                                Belum ada data hasil panen yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('modals')
    <div id="modalTambahPanen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs hidden transition-opacity duration-300">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-brand-border space-y-5 max-h-[90vh] overflow-y-auto no-scrollbar">
            <div class="flex items-center justify-between border-b border-brand-border pb-3">
                <div>
                    <h3 class="font-serif font-bold text-lg text-brand-espresso">Catat Hasil Panen</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Setorkan data timbangan hasil panen tembakau ke sentra.</p>
                </div>
                <button type="button" onclick="closeModalTambahPanen()" class="w-8 h-8 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 flex items-center justify-center transition-colors cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('dashboard.panen.store') }}" method="POST" class="space-y-4 text-xs">
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
                        <label class="block font-semibold text-brand-espresso mb-1">Grade Mutu <span class="text-red-500">*</span></label>
                        <select name="grade" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors cursor-pointer">
                            <option value="Super">Super (Mutu Tertinggi)</option>
                            <option value="Gudangan">Gudangan (Standar Pabrik)</option>
                            <option value="CW (AB-1)">CW (AB-1 Rajangan Halus)</option>
                            <option value="CW (C-1)">CW (C-1 Rajangan Sedang)</option>
                            <option value="Asalan">Asalan Kebun</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Berat Panen (Kg) <span class="text-red-500">*</span></label>
                        <input type="number" name="harvest_weight_kg" min="1" required placeholder="Contoh: 450" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Jenis Rajangan</label>
                        <select name="moisture_content" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                            <option value="Rajang Halus">Rajang Halus</option>
                            <option value="Rajang Kasar">Rajang Kasar</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-brand-espresso mb-1">Tanggal Panen <span class="text-red-500">*</span></label>
                        <input type="date" name="harvest_date" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Lokasi Kebun / Ladang</label>
                    <input type="text" name="farm_location" value="{{ Auth::user()->farm_location ?? 'Situbondo, Jawa Timur' }}" placeholder="Contoh: Lahan Krajan, Besuki" class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors">
                </div>

                <div>
                    <label class="block font-semibold text-brand-espresso mb-1">Catatan Kualitas &amp; Tekstur</label>
                    <textarea name="quality_notes" rows="2" placeholder="Catatan aroma harum getah, warna rajangan, atau proses penjemuran..." class="w-full px-3.5 py-2.5 rounded-xl border border-brand-border bg-brand-surface focus:bg-white focus:border-brand-gold focus:outline-none text-sm transition-colors"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-brand-border">
                    <button type="button" onclick="closeModalTambahPanen()" class="px-5 py-2.5 rounded-xl border border-brand-border hover:bg-stone-100 text-stone-600 font-bold transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-gold hover:bg-brand-goldHover text-white font-bold transition-all shadow-md cursor-pointer">
                        Simpan Hasil Panen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalTambahPanen() {
            document.getElementById('modalTambahPanen').classList.remove('hidden');
        }

        function closeModalTambahPanen() {
            document.getElementById('modalTambahPanen').classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModalTambahPanen();
            }
        });
    </script>
@endpush

@extends('layouts.dashboard')

@section('title', 'Rekomendasi Tanam Tembakau — Serean Tobacco')
@section('page_title', 'Rekomendasi Tanam Tembakau')

@section('content')
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-serif font-bold text-lg text-brand-espresso">Kalender Musim Tanam Tembakau Jawa Timur</h3>
                <p class="text-xs text-brand-muted">Siklus bulanan optimal untuk varietas Rajangan Halus &amp; Na-Oogst.</p>
            </div>
            <a href="{{ route('dashboard.jadwal') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-surface hover:bg-stone-100 border border-brand-border text-brand-espresso text-xs font-bold transition-all shadow-xs shrink-0">
                <i class="fa-solid fa-calendar-plus text-amber-500"></i>
                <span>Buat Jadwal Tanam</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm space-y-3 relative overflow-hidden group hover:border-brand-gold/60 transition-all">
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center text-base font-serif font-bold">
                    01
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sky-700 bg-sky-50 px-2 py-0.5 rounded-md inline-block mb-1">April – Mei</span>
                    <h4 class="font-serif font-bold text-sm text-brand-espresso">Persemaian Bibit</h4>
                </div>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Siapkan bedengan semai gembur dengan naungan plastik 50%. Bibit siap dipindah tanam pada umur 35–45 hari saat berdaun 5–6 helai.
                </p>
                <div class="pt-2 border-t border-brand-border text-[11px] text-stone-500 flex items-center gap-1.5 font-medium">
                    <i class="fa-solid fa-droplet text-sky-500"></i>
                    <span>Siram rutin pagi &amp; sore</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm space-y-3 relative overflow-hidden group hover:border-brand-gold/60 transition-all">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center text-base font-serif font-bold">
                    02
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded-md inline-block mb-1">Mei – Juni</span>
                    <h4 class="font-serif font-bold text-sm text-brand-espresso">Pindah Tanam (Transplanting)</h4>
                </div>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Tanam bibit sore hari untuk meminimalkan stres. Gunakan jarak tanam ideal 90 x 50 cm di atas guludan/bedengan tinggi 30–40 cm.
                </p>
                <div class="pt-2 border-t border-brand-border text-[11px] text-stone-500 flex items-center gap-1.5 font-medium">
                    <i class="fa-solid fa-arrows-left-right text-indigo-500"></i>
                    <span>Populasi ~22.000 bibit/Ha</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm space-y-3 relative overflow-hidden group hover:border-brand-gold/60 transition-all">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-base font-serif font-bold">
                    03
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md inline-block mb-1">Juni – Juli</span>
                    <h4 class="font-serif font-bold text-sm text-brand-espresso">Bumbun, Topping &amp; Wiwil</h4>
                </div>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Lakukan pendangiran tanah (bumbun). Pangkas bunga kuncup (topping) dan wiwil tunas ketiak daun agar sari makanan fokus menebalkan daun.
                </p>
                <div class="pt-2 border-t border-brand-border text-[11px] text-stone-500 flex items-center gap-1.5 font-medium">
                    <i class="fa-solid fa-scissors text-amber-600"></i>
                    <span>Topping saat kuncup keluar</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-brand-border shadow-sm space-y-3 relative overflow-hidden group hover:border-brand-gold/60 transition-all">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base font-serif font-bold">
                    04
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md inline-block mb-1">Agustus – Oktober</span>
                    <h4 class="font-serif font-bold text-sm text-brand-espresso">Panen Bertahap &amp; Curing</h4>
                </div>
                <p class="text-xs text-brand-muted leading-relaxed">
                    Petik bertahap saat daun menguning keemasan dan bergetah harum. Lakukan proses pengeringan matahari atau curing hingga kadar air 12–14%.
                </p>
                <div class="pt-2 border-t border-brand-border text-[11px] text-stone-500 flex items-center gap-1.5 font-medium">
                    <i class="fa-solid fa-sun text-emerald-600"></i>
                    <span>Kadar air target 12–14%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-7 bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 space-y-5">
            <div class="border-b border-brand-border pb-3">
                <h3 class="font-serif font-extrabold text-lg text-brand-espresso">Karakter Varietas Unggulan Sentra</h3>
                <p class="text-xs text-brand-muted mt-0.5">Karakteristik kultivar tembakau yang memiliki serapan tertinggi oleh pabrikan.</p>
            </div>

            <div class="space-y-4">
                <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-serif font-bold text-sm text-brand-espresso">Tembakau Opot (Besuki Na-Oogst)</h4>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-brand-gold border border-brand-gold/30">
                            Grade Super Ekspor
                        </span>
                    </div>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Kultivar legendaris khas kawasan Besuki. Daun elastis, halus, dan beraroma harum alami. Sangat cocok ditanam di tanah aluvial subur dengan drainase lancar.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] text-brand-muted pt-1">
                        <span class="bg-white px-2 py-1 rounded-lg border border-brand-border font-medium">Panen: 70–80 HST</span>
                        <span class="bg-white px-2 py-1 rounded-lg border border-brand-border font-medium">Potensi: 800–1.200 Kg/Ha</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-serif font-bold text-sm text-brand-espresso">Tembakau Samporis</h4>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Favorit Pabrikan Kretek
                        </span>
                    </div>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Tahan terhadap cuaca kemarau terik dengan daya adaptasi tinggi di lahan tegalan. Menghasilkan rajangan beraroma gurih alami dan warna kuning keemasan seragam.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] text-brand-muted pt-1">
                        <span class="bg-white px-2 py-1 rounded-lg border border-brand-border font-medium">Panen: 65–75 HST</span>
                        <span class="bg-white px-2 py-1 rounded-lg border border-brand-border font-medium">Potensi: 900–1.400 Kg/Ha</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-brand-surface border border-brand-border space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-serif font-bold text-sm text-brand-espresso">Tembakau Marakot</h4>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                            Aroma Manis Alami
                        </span>
                    </div>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Kadar getah alami melimpah, tekstur helai daun tebal, dan memberikan tarikan lembut manis saat dirajang halus. Sangat disukai untuk racikan rokok kretek tangan.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] text-brand-muted pt-1">
                        <span class="bg-white px-2 py-1 rounded-lg border border-brand-border font-medium">Panen: 75–85 HST</span>
                        <span class="bg-white px-2 py-1 rounded-lg border border-brand-border font-medium">Potensi: 850–1.100 Kg/Ha</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 space-y-4">
                <div class="border-b border-brand-border pb-3">
                    <h3 class="font-serif font-extrabold text-base text-brand-espresso">Standar Agroklimat Lahan</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Kondisi lahan terbaik untuk pertumbuhan prima.</p>
                </div>

                <div class="space-y-3 text-xs">
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-brand-surface border border-brand-border">
                        <div class="w-7 h-7 rounded-lg bg-white text-brand-gold flex items-center justify-center shrink-0 text-sm shadow-xs">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                        <div>
                            <span class="font-bold text-brand-espresso block">pH Tanah Optimal: 5.5 – 6.8</span>
                            <span class="text-brand-muted text-[11px]">Tanah gembur kaya humus dengan struktur lempung berpasir.</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 rounded-xl bg-brand-surface border border-brand-border">
                        <div class="w-7 h-7 rounded-lg bg-white text-amber-600 flex items-center justify-center shrink-0 text-sm shadow-xs">
                            <i class="fa-solid fa-sun"></i>
                        </div>
                        <div>
                            <span class="font-bold text-brand-espresso block">Penyinaran Matahari: 8–10 Jam/Hari</span>
                            <span class="text-brand-muted text-[11px]">Paparan sinar penuh meningkatkan pembentukan nikotin &amp; aroma.</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 rounded-xl bg-brand-surface border border-brand-border">
                        <div class="w-7 h-7 rounded-lg bg-white text-blue-600 flex items-center justify-center shrink-0 text-sm shadow-xs">
                            <i class="fa-solid fa-water"></i>
                        </div>
                        <div>
                            <span class="font-bold text-brand-espresso block">Drainase Wajib Bebas Genangan</span>
                            <span class="text-brand-muted text-[11px]">Tembakau rentan layu bakteri jika akar tergenang air lebih dari 24 jam.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-brand-border shadow-sm p-6 sm:p-7 space-y-4">
                <div class="border-b border-brand-border pb-3">
                    <h3 class="font-serif font-extrabold text-base text-brand-espresso">Dosis Pemupukan Berimbang</h3>
                    <p class="text-xs text-brand-muted mt-0.5">Anjuran per 1 Hektar lahan tembakau.</p>
                </div>

                <ul class="space-y-2 text-xs text-stone-600">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-600 text-xs mt-0.5"></i>
                        <span><strong>Pupuk Dasar:</strong> Kompos matang 10–15 Ton + SP-36 (150 Kg) saat olah tanah.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-600 text-xs mt-0.5"></i>
                        <span><strong>Susulan I (15 HST):</strong> ZA 100 Kg + NPK rendah klorin 150 Kg.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-emerald-600 text-xs mt-0.5"></i>
                        <span><strong>Susulan II (35 HST):</strong> ZK (Kalium Sulfat) 150 Kg untuk mutu daun &amp; daya bakar abu putih.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection

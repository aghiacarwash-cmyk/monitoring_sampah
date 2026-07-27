@extends('user.header')
@section('content')

<div class="px-4 md:px-8 py-6 space-y-6">

    {{-- PETA --}}
    <section class="relative w-full rounded-xl overflow-hidden border border-outline-variant shadow-sm" style="height: 50vw; min-height: 220px; max-height: 500px;">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <div id="map" class="w-full h-full z-10"></div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap' }).addTo(map);
        var bounds = [];
        function createIcon(color) {
            return L.divIcon({
                className: '',
                html: `<div style="width:18px;height:18px;background:${color};border:3px solid white;border-radius:50%;box-shadow:0 0 8px rgba(0,0,0,0.4);"></div>`,
                iconSize: [18, 18], iconAnchor: [9, 9]
            });
        }
        @foreach ($containers as $container)
            @if ($container->latitude && $container->longitude)
                @php
                    $color = $container->persen >= 81 ? '#dc2626' : ($container->persen >= 11 ? '#f59e0b' : '#16a34a');
                    $status = $container->persen >= 81 ? 'Penuh' : ($container->persen >= 11 ? 'Berisi' : 'Kosong');
                @endphp
                bounds.push([{{ $container->latitude }}, {{ $container->longitude }}]);
                L.marker([{{ $container->latitude }}, {{ $container->longitude }}], { icon: createIcon('{{ $color }}') })
                    .addTo(map)
                    .bindPopup(`<div style="width:200px">
                        <h3 style="font-size:15px;font-weight:bold;color:#00535b;margin-bottom:6px;">{{ $container->kode_containers }}</h3>
                        <p style="margin-bottom:4px;font-size:13px;"><b>Lokasi:</b> {{ $container->nama_lokasi }}</p>
                        <p style="margin-bottom:4px;font-size:13px;"><b>Status:</b> {{ $status }}</p>
                        <p style="margin-bottom:4px;font-size:13px;"><b>Penuh:</b> {{ $container->persen }}%</p>
                        <p style="margin-bottom:8px;font-size:13px;"><b>Baterai:</b> {{ $container->baterai }}%</p>
                        <a href="https://www.google.com/maps?q={{ $container->latitude }},{{ $container->longitude }}" target="_blank"
                            style="display:inline-block;padding:6px 12px;background:#00535b;color:white;border-radius:8px;text-decoration:none;font-size:13px;">📍 Google Maps</a>
                    </div>`);
            @endif
        @endforeach
        if (bounds.length > 0) { map.fitBounds(bounds, { padding: [40, 40] }); } else { map.setView([-6.2, 106.8], 11); }
    </script>

    {{-- STATISTIK --}}
    @php
        $totalContainer   = $containers->count();
        $tongPenuh        = $containers->where('persen', '>=', 81)->count();
        $tongBerisi       = $containers->whereBetween('persen', [11, 80])->count();
        $tongKosong       = $containers->where('persen', '<=', 10)->count();
        $perluPengosongan = $containers->where('persen', '>=', 80)->count();
        $lowBattery       = $containers->where('baterai', '<=', 20)->count();
        $totalWarning     = $perluPengosongan + $lowBattery;
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        @foreach ([
            ['Total', $totalContainer, 'text-primary', 'Total Aktif'],
            ['Perlu Pengosongan', $perluPengosongan, 'text-red-600', 'Prioritas Tinggi'],
            ['Tong Kosong', $tongKosong, 'text-green-600', 'Optimal'],
            ['Tong Berisi', $tongBerisi, 'text-orange-500', 'Normal'],
            ['Tong Penuh', $tongPenuh, 'text-red-600', 'Segera'],
        ] as [$label, $val, $color, $sub])
        <div class="bg-white border border-outline-variant p-4 rounded-xl shadow-sm">
            <p class="text-xs text-on-surface-variant mb-1">{{ $label }}</p>
            <div class="flex justify-between items-end">
                <span class="text-3xl font-bold {{ $color }}">{{ $val }}</span>
                <span class="text-xs font-semibold {{ $color }} mb-1">{{ $sub }}</span>
            </div>
        </div>
        @endforeach
    </div>

    {{-- TABEL --}}
    <div class="bg-white border border-outline-variant rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h3 class="font-semibold text-primary text-base">Ringkasan Status Tong Sampah</h3>
                <p class="text-xs text-on-surface-variant">Laporan status semua sensor IoT</p>
            </div>
            <a href="/export-excel"
                class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition flex items-center gap-2 self-start">
                <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-surface-container-low border-b border-outline-variant text-xs uppercase text-on-surface-variant">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3 hidden md:table-cell">Lokasi</th>
                        <th class="px-4 py-3 hidden md:table-cell">Kecamatan</th>
                        <th class="px-4 py-3 hidden lg:table-cell">Kelurahan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 hidden sm:table-cell">Penuh</th>
                        <th class="px-4 py-3 hidden sm:table-cell">Baterai</th>
                        <th class="px-4 py-3 hidden lg:table-cell">Update</th>
                        <th class="px-4 py-3">Maps</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                    @forelse ($containers as $container)
                        @php
                            if ($container->persen >= 81)      { $status = 'Penuh';  $statusBg = 'bg-red-500 text-white';    $barBg = 'bg-red-500';    $tc = 'text-red-600'; }
                            elseif ($container->persen >= 11)  { $status = 'Berisi'; $statusBg = 'bg-orange-400 text-white'; $barBg = 'bg-orange-400'; $tc = 'text-orange-500'; }
                            else                               { $status = 'Kosong'; $statusBg = 'bg-green-500 text-white';  $barBg = 'bg-green-500';  $tc = 'text-green-600'; }
                        @endphp
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-semibold text-primary text-xs">
                                {{ $container->kode_containers }}
                                {{-- Info tambahan di mobile --}}
                                <div class="md:hidden text-gray-500 font-normal mt-0.5">{{ $container->nama_lokasi }}</div>
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell">{{ $container->nama_lokasi }}</td>
                            <td class="px-4 py-3 hidden md:table-cell text-xs">{{ $container->kecamatan->nama_kecamatan ?? '-' }}</td>
                            <td class="px-4 py-3 hidden lg:table-cell text-xs">{{ $container->kelurahan->nama_kelurahan ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $statusBg }}">{{ $status }}</span>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell">
                                <div class="w-20 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full {{ $barBg }}" style="width: {{ $container->persen }}%"></div>
                                </div>
                                <span class="text-xs font-bold {{ $tc }}">{{ $container->persen }}%</span>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell text-xs font-semibold">{{ $container->baterai }}%</td>
                            <td class="px-4 py-3 hidden lg:table-cell text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($container->updated_at)->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3">
                                <a href="https://www.google.com/maps?q={{ $container->latitude }},{{ $container->longitude }}"
                                    target="_blank"
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white hover:scale-110 transition">
                                    <span class="material-symbols-outlined text-base">location_on</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10" class="text-center py-10 text-gray-400 text-sm">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- FLOAT WARNING BUTTON --}}
<div class="fixed bottom-6 right-6 z-50">
    <button onclick="document.getElementById('warningModal').classList.remove('hidden'); document.getElementById('warningModal').classList.add('flex');"
        class="bg-error text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform active:scale-95 relative">
        <span class="material-symbols-outlined text-[28px]" style='font-variation-settings: "FILL" 1;'>warning</span>
        <span class="absolute -top-1 -right-1 w-5 h-5 bg-white text-error rounded-full text-[10px] flex items-center justify-center font-bold border-2 border-error">
            {{ $totalWarning }}
        </span>
    </button>
</div>

{{-- MODAL WARNING --}}
<div id="warningModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[999] p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-error text-white px-5 py-4 flex justify-between items-center">
            <h2 class="text-base font-bold flex items-center gap-2">
                <span class="material-symbols-outlined">warning</span> Peringatan
            </h2>
            <button onclick="document.getElementById('warningModal').classList.remove('flex'); document.getElementById('warningModal').classList.add('hidden');">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-4 max-h-[70vh] overflow-y-auto space-y-4">
            <h3 class="font-bold text-red-600">Tong Penuh (≥80%)</h3>
            @forelse ($containers->where('persen', '>=', 80) as $c)
                <div class="border border-red-200 rounded-xl p-3 bg-red-50 flex justify-between items-center gap-3">
                    <div>
                        <div class="font-bold text-red-700 text-sm">{{ $c->kode_containers }}</div>
                        <div class="text-xs text-gray-600">{{ $c->nama_lokasi }}</div>
                        <div class="text-xs mt-0.5">Penuh: <span class="font-bold text-red-600">{{ $c->persen }}%</span></div>
                    </div>
                    <a href="https://www.google.com/maps?q={{ $c->latitude }},{{ $c->longitude }}" target="_blank"
                        class="bg-error text-white px-3 py-1.5 rounded-lg text-xs font-semibold flex-shrink-0">Maps</a>
                </div>
            @empty
                <p class="text-sm text-gray-400">Tidak ada tong penuh</p>
            @endforelse

            <h3 class="font-bold text-orange-500 pt-2">Baterai Lemah (≤20%)</h3>
            @forelse ($containers->where('baterai', '<=', 20) as $c)
                <div class="border border-orange-200 rounded-xl p-3 bg-orange-50 flex justify-between items-center gap-3">
                    <div>
                        <div class="font-bold text-orange-600 text-sm">{{ $c->kode_containers }}</div>
                        <div class="text-xs text-gray-600">{{ $c->nama_lokasi }}</div>
                        <div class="text-xs mt-0.5">Baterai: <span class="font-bold text-orange-500">{{ $c->baterai }}%</span></div>
                    </div>
                    <a href="https://www.google.com/maps?q={{ $c->latitude }},{{ $c->longitude }}" target="_blank"
                        class="bg-orange-500 text-white px-3 py-1.5 rounded-lg text-xs font-semibold flex-shrink-0">Maps</a>
                </div>
            @empty
                <p class="text-sm text-gray-400">Tidak ada baterai lemah</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
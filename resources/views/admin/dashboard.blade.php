@extends('admin.app')

@section('content')

    <main class="p-8 space-y-6">

        <!-- MAP -->
        <!-- MAP CONTAINER -->
        <!-- MAP SECTION -->
        <section class="relative w-full h-[500px] rounded-xl overflow-hidden border border-outline-variant shadow-sm">

            <!-- LEAFLET CSS -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

            <!-- MAP -->
            <div id="map" class="w-full h-full z-10"></div>

        </section>

        <!-- LEAFLET JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>

            // =========================
            // INIT MAP
            // =========================
            var map = L.map('map');

            // =========================
            // TILE LAYER
            // =========================
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '&copy; OpenStreetMap'

            }).addTo(map);

            // =========================
            // ARRAY UNTUK AUTO ZOOM
            // =========================
            var bounds = [];

            // =========================
            // CUSTOM ICON
            // =========================
            function createIcon(color) {

                return L.divIcon({

                    className: '',

                    html: `
                                    <div style="
                                        width:20px;
                                        height:20px;
                                        background:${color};
                                        border:3px solid white;
                                        border-radius:50%;
                                        box-shadow:0 0 10px rgba(0,0,0,0.4);
                                    "></div>
                                `,

                    iconSize: [20, 20],
                    iconAnchor: [10, 10]

                });

            }

            // =========================
            // LOOP DATA CONTAINER
            // =========================
            @foreach ($containers as $container)

                @if ($container->latitude && $container->longitude)

                    @php

                        if ($container->persen >= 81) {

                            $status = 'Penuh';
                            $color = '#dc2626';

                        } elseif ($container->persen >= 11) {

                            $status = 'Berisi';
                            $color = '#f59e0b';

                        } else {

                            $status = 'Kosong';
                            $color = '#16a34a';

                        }

                    @endphp

                    // KOORDINAT
                    var lat = {{ $container->latitude }};
                    var lng = {{ $container->longitude }};

                    // MASUKKAN KE ARRAY BOUNDS
                    bounds.push([lat, lng]);

                    // =========================
                    // MARKER
                    // =========================
                    var marker = L.marker(
                        [lat, lng],
                        {
                            icon: createIcon('{{ $color }}')
                        }
                    ).addTo(map);

                    // =========================
                    // POPUP
                    // =========================
                    marker.bindPopup(`

                                                                            <div style="width:220px">

                                                                                <h3 style="
                                                                                    font-size:16px;
                                                                                    font-weight:bold;
                                                                                    margin-bottom:8px;
                                                                                    color:#00535b;
                                                                                ">
                                                                                    {{ $container->kode_containers }}
                                                                                </h3>

                                                                                <p style="margin-bottom:6px;">
                                                                                    <b>Lokasi:</b><br>
                                                                                    {{ $container->nama_lokasi }}
                                                                                </p>

                                                                                <p style="margin-bottom:6px;">
                                                                                    <b>Status:</b>
                                                                                    {{ $status }}
                                                                                </p>

                                                                                <p style="margin-bottom:6px;">
                                                                                    <b>Persentase:</b>
                                                                                    {{ $container->persen }}%
                                                                                </p>

                                                                                <p style="margin-bottom:10px;">
                                                                                    <b>Baterai:</b>
                                                                                    {{ $container->baterai }}%
                                                                                </p>

                                                                                <a href="https://www.google.com/maps?q={{ $container->latitude }},{{ $container->longitude }}"
                                                                                    target="_blank"
                                                                                    style="
                                                                                        display:inline-block;
                                                                                        padding:8px 12px;
                                                                                        background:#00535b;
                                                                                        color:white;
                                                                                        border-radius:8px;
                                                                                        text-decoration:none;
                                                                                        font-size:14px;
                                                                                        font-weight:600;
                                                                                    ">

                                                                                    📍 Buka Google Maps

                                                                                </a>

                                                                            </div>

                                                                        `);

                @endif

            @endforeach

                        // =========================
                        // AUTO FOCUS KE TITIK
                        // =========================
                        if (bounds.length > 0) {

                map.fitBounds(bounds, {

                    padding: [50, 50]

                });

            } else {

                // DEFAULT JIKA TIDAK ADA DATA
                map.setView([-6.200000, 106.816666], 11);

            }

        </script>

        {{-- <!-- TITLE -->
        <div
            class="absolute top-6 left-6 bg-white/90 backdrop-blur-md p-5 rounded-lg border border-outline-variant shadow-lg max-w-xs">

            <h2 class="text-xl font-semibold text-primary mb-2">
                Maps Kontainer
            </h2>

            <div class="mt-4 flex gap-4">

                <div class="flex items-center gap-1">
                    <span class="w-3 h-3 rounded-full bg-primary"></span>
                    <span class="text-[10px]">Kosong</span>
                </div>

                <div class="flex items-center gap-1">
                    <span class="w-3 h-3 rounded-full bg-yellow-700"></span>
                    <span class="text-[10px]">Berisi</span>
                </div>

                <div class="flex items-center gap-1">
                    <span class="w-3 h-3 rounded-full bg-red-600"></span>
                    <span class="text-[10px]">Penuh</span>
                </div>

            </div>
        </div>

        </section> --}}

        <!-- TABLE -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            {{-- TOTAL --}}
            <div onclick="showTable('all')"
                class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm cursor-pointer hover:shadow-lg transition">

                <p class="text-sm text-on-surface-variant mb-2">
                    Total Tong Sampah
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->count() }}
                </h4>

            </div>

            {{-- PENUH --}}
            <div onclick="showTable('penuh')"
                class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm cursor-pointer hover:shadow-lg transition">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Penuh
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 81)->count() }}
                </h4>

            </div>

            {{-- BERISI --}}
            <div onclick="showTable('berisi')"
                class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm cursor-pointer hover:shadow-lg transition">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Berisi
                </p>

                <h4 class="text-4xl font-bold text-yellow-700">
                    {{ $containers->whereBetween('persen', [11, 80])->count() }}
                </h4>

            </div>

            {{-- KOSONG --}}
            <div onclick="showTable('kosong')"
                class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm cursor-pointer hover:shadow-lg transition">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Kosong
                </p>

                <h4 class="text-4xl font-bold text-green-600">
                    {{ $containers->whereBetween('persen', [0, 10])->count() }}
                </h4>

            </div>

            {{-- URGENT --}}
            <div onclick="showTable('urgent')"
                class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm cursor-pointer hover:shadow-lg transition">

                <p class="text-sm text-on-surface-variant mb-2">
                    Butuh Pengosongan
                </p>

                <h4 class="text-4xl font-bold text-red-700">
                    {{ $containers->where('persen', '>=', 90)->count() }}
                </h4>

            </div>

        </div>

        {{-- ========================================= --}}
        {{-- MODAL TABLE --}}
        {{-- ========================================= --}}

        <div id="tableModal" class="fixed inset-0 bg-black/50 hidden z-50 items-center justify-center">

            <div class="bg-white w-[95%] max-h-[90vh] overflow-auto rounded-2xl p-6 shadow-2xl">

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-5">

                    <h2 id="modalTitle" class="text-2xl font-bold text-primary">
                        Data Container
                    </h2>

                    <button onclick="closeModal()"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                        Tutup
                    </button>

                </div>

                {{-- TABLE --}}
                    <livewire:admin-dashboard/>


            </div>

        </div>

        {{-- ========================================= --}}
        {{-- SCRIPT --}}
        {{-- ========================================= --}}

        <script>

            const containers = @json($containers);

            function showTable(type) {
                const modal = document.getElementById('tableModal');
                const tableBody = document.getElementById('tableBody');
                const modalTitle = document.getElementById('modalTitle');

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                let filtered = [];

                if (type === 'all') {
                    modalTitle.innerHTML = 'Semua Container';
                    filtered = containers;
                }
                else if (type === 'penuh') {
                    modalTitle.innerHTML = 'Container Penuh';
                    filtered = containers.filter(c => c.persen >= 81);
                }
                else if (type === 'berisi') {
                    modalTitle.innerHTML = 'Container Berisi';
                    filtered = containers.filter(c => c.persen >= 11 && c.persen <= 80);
                }
                else if (type === 'kosong') {
                    modalTitle.innerHTML = 'Container Kosong';
                    filtered = containers.filter(c => c.persen <= 10);
                }
                else if (type === 'urgent') {
                    modalTitle.innerHTML = 'Butuh Pengosongan';
                    filtered = containers.filter(c => c.persen >= 90);
                }

                let html = '';

                if (filtered.length > 0) {
                    filtered.forEach((container, index) => {

                        let status = 'Kosong';
                        let color = 'text-green-600';

                        if (container.persen >= 81) {
                            status = 'Penuh';
                            color = 'text-red-600';
                        }
                        else if (container.persen >= 11) {
                            status = 'Berisi';
                            color = 'text-yellow-600';
                        }

                        html += `

                            <tr class="hover:bg-gray-50 transition">

                                <td class="border border-gray-300 px-4 py-3">
                                    ${index + 1}
                                </td>

                                <td class="border border-gray-300 px-4 py-3 font-semibold">
                                    ${container.kode_containers ?? '-'}
                                </td>

                                <td class="border border-gray-300 px-4 py-3">
                                    ${container.nama_lokasi ?? '-'}
                                </td>

                                <td class="border border-gray-300 px-4 py-3">

                                    <span class="${color} font-bold">
                                        ${status}
                                    </span>

                                </td>

                                <td class="border border-gray-300 px-4 py-3">

                                    <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">

                                        <div class="bg-cyan-600 h-full"
                                            style="width:${container.persen}%">
                                        </div>

                                    </div>

                                    <span class="text-xs font-bold mt-1 inline-block">
                                        ${container.persen}%
                                    </span>

                                </td>

                                <td class="border border-gray-300 px-4 py-3">
                                    ${container.baterai ?? 0}%
                                </td>

                                <td class="border border-gray-300 px-4 py-3">
                                    ${container.latitude ?? '-'}
                                </td>

                                <td class="border border-gray-300 px-4 py-3">
                                    ${container.longitude ?? '-'}
                                </td>

                                <td class="border border-gray-300 px-4 py-3 text-center">

                                    <a href="https://www.google.com/maps?q=${container.latitude},${container.longitude}"
                                        target="_blank"
                                        class="bg-primary text-white px-3 py-2 rounded-lg text-xs hover:bg-cyan-800 transition">

                                        Maps

                                    </a>

                                </td>

                            </tr>

                        `;
                    });
                }
                else {
                    html = `

                        <tr>

                            <td colspan="9"
                                class="border border-gray-300 px-4 py-5 text-center">

                                Data tidak ada

                            </td>

                        </tr>

                    `;
                }

                tableBody.innerHTML = html;
            }

            function closeModal() {
                const modal = document.getElementById('tableModal');

                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

        </script>
        <div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
            <div class="p-card-padding border-b border-outline-variant flex justify-between items-center bg-white">
                <div>
                    <h3 class="font-h2 text-h2 text-primary">Ringkasan Status Tong Sampah</h3>
                    <p class="text-body-md text-on-surface-variant">Laporan status terperinci untuk semua sensor IoT yang
                        terhubung</p>
                </div>
                <a href="/export-excel"
                    class="bg-primary text-on-primary px-stack-lg py-2 rounded-lg font-bold hover:opacity-90 transition-all flex items-center gap-2">

                    <span class="material-symbols-outlined text-[18px]">
                        download
                    </span>

                    Ekspor Excel

                </a>
            </div>



            <div class="overflow-x-auto">

                    <livewire:admin-dashboard />
            </div>
        </div>

        
        

        <!-- SCRIPT -->
        <script>

            function openWarningModal() {

                document.getElementById('warningModal')
                    .classList.remove('hidden');

                document.getElementById('warningModal')
                    .classList.add('flex');

            }

            function closeWarningModal() {

                document.getElementById('warningModal')
                    .classList.remove('flex');

                document.getElementById('warningModal')
                    .classList.add('hidden');

            }

        </script>


    </main>

@endsection
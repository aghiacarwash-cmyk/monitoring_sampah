@extends('header')

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
        <div class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">



            <div class="overflow-x-auto">

                        <livewire:dashboard/>
            </div>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">
                <p class="text-sm text-on-surface-variant mb-2">
                    Total Tong Sampah
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->count() }}
                </h4>
            </div>

            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">
                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Penuh
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 81)->count() }}
                </h4>
            </div>

            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">
                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Berisi
                </p>

                <h4 class="text-4xl font-bold text-yellow-700">
                    {{ $containers->whereBetween('persen', [11, 80])->count() }}
                </h4>
            </div>

            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">
                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Kosong
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->whereBetween('persen', [0, 10])->count() }}
                </h4>
            </div>

            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">
                <p class="text-sm text-on-surface-variant mb-2">
                    Butuh Pengosongan
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 90)->count() }}
                </h4>
            </div>

        </div>

    </main>



@endsection
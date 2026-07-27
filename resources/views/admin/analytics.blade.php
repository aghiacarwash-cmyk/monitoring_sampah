@extends('admin.app')

@section('content')

    <div class="space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl font-bold text-on-surface">
                Analytics Dashboard
            </h1>

            <p class="text-on-surface-variant mt-1">
                Analisis kondisi seluruh kontainer sampah secara realtime.
            </p>
        </div>

        <!-- =========================
        CARD STATISTIK
        ========================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

            <!-- TOTAL -->
            <div class="bg-white border border-outline-variant rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <p class="text-sm text-on-surface-variant">
                            Total Kontainer
                        </p>

                        <h2 class="text-4xl font-bold text-primary mt-2">
                            {{ $containers->count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-cyan-100 flex items-center justify-center">

                        <span class="material-symbols-outlined text-cyan-700 text-3xl">
                            delete
                        </span>

                    </div>

                </div>

            </div>

            <!-- KOSONG -->
            <div class="bg-white border border-outline-variant rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <p class="text-sm text-on-surface-variant">
                            Tong Kosong
                        </p>

                        <h2 class="text-4xl font-bold text-teal-600 mt-2">
                            {{ $containers->whereBetween('persen', [0, 10])->count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center">

                        <span class="material-symbols-outlined text-teal-700 text-3xl">
                            delete_outline
                        </span>

                    </div>

                </div>

            </div>

            <!-- BERISI -->
            <div class="bg-white border border-outline-variant rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <p class="text-sm text-on-surface-variant">
                            Tong Berisi
                        </p>

                        <h2 class="text-4xl font-bold text-yellow-500 mt-2">
                            {{ $containers->whereBetween('persen', [11, 80])->count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                        <span class="material-symbols-outlined text-yellow-700 text-3xl">
                            recycling
                        </span>

                    </div>

                </div>

            </div>

            <!-- PENUH -->
            <div class="bg-white border border-outline-variant rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <p class="text-sm text-on-surface-variant">
                            Tong Penuh
                        </p>

                        <h2 class="text-4xl font-bold text-red-500 mt-2">
                            {{ $containers->where('persen', '>=', 81)->count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                        <span class="material-symbols-outlined text-red-700 text-3xl">
                            warning
                        </span>

                    </div>

                </div>

            </div>

            <!-- BATERAI -->
            <div class="bg-white border border-outline-variant rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <p class="text-sm text-on-surface-variant">
                            Baterai Lemah
                        </p>

                        <h2 class="text-4xl font-bold text-orange-500 mt-2">
                            {{ $containers->where('baterai', '<=', 20)->count() }}
                        </h2>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">

                        <span class="material-symbols-outlined text-orange-700 text-3xl">
                            battery_alert
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- =========================
        CHART SECTION
        ========================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- DOUGHNUT -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-outline-variant">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-xl font-bold">
                            Statistik Kontainer
                        </h2>

                        <p class="text-sm text-on-surface-variant">
                            Distribusi kondisi kontainer
                        </p>
                    </div>

                </div>

                <canvas id="statusChart" height="220"></canvas>

            </div>

            <!-- BAR -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-outline-variant">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-xl font-bold">
                            Perbandingan Status
                        </h2>

                        <p class="text-sm text-on-surface-variant">
                            Grafik jumlah berdasarkan status
                        </p>
                    </div>

                </div>

                <canvas id="barChart" height="220"></canvas>

            </div>

        </div>

        <!-- =========================
        TABLE WARNING
        ========================== -->
        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-outline-variant">

                <h2 class="text-xl font-bold">
                    Kontainer Bermasalah
                </h2>

                <p class="text-sm text-on-surface-variant mt-1">
                    Kontainer penuh dan baterai lemah
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-surface-container-low">

                        <tr class="text-left text-sm text-on-surface-variant">

                            <th class="px-6 py-4">
                                Kode
                            </th>

                            <th class="px-6 py-4">
                                Lokasi
                            </th>

                            <th class="px-6 py-4">
                                Persentase
                            </th>

                            <th class="px-6 py-4">
                                Baterai
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center">
                                Maps
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($containers->where('persen', '>=', 81) as $container)

                            <tr class="border-t border-outline-variant hover:bg-surface-container-low transition">

                                <!-- KODE -->
                                <td class="px-6 py-4 font-semibold">
                                    {{ $container->kode_containers }}
                                </td>

                                <!-- LOKASI -->
                                <td class="px-6 py-4">
                                    {{ $container->nama_lokasi }}
                                </td>

                                <!-- PERSENTASE -->
                                <td class="px-6 py-4 text-red-600 font-bold">
                                    {{ $container->persen }}%
                                </td>

                                <!-- BATERAI -->
                                <td class="px-6 py-4">
                                    {{ $container->baterai }}%
                                </td>

                                <!-- STATUS -->
                                <td class="px-6 py-4">

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                        Penuh
                                    </span>

                                </td>

                                <!-- MAPS -->
                                <td class="px-6 py-4 text-center">

                                    <a href="https://www.google.com/maps?q={{ $container->latitude }},{{ $container->longitude }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-1 bg-primary text-white px-4 py-2 rounded-lg hover:scale-105 transition">

                                        <span class="material-symbols-outlined text-[18px]">
                                            map
                                        </span>

                                        Maps

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-10 text-gray-500">
                                    Tidak ada data warning
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- =========================
    CHART JS
    ========================= -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const kosong = {{ $containers->whereBetween('persen', [0, 10])->count() }};
        const berisi = {{ $containers->whereBetween('persen', [11, 80])->count() }};
        const penuh = {{ $containers->where('persen', '>=', 81)->count() }};

        // =========================
        // DOUGHNUT CHART
        // =========================
        const ctx = document.getElementById('statusChart');

        new Chart(ctx, {

            type: 'doughnut',

            data: {

                labels: ['Kosong', 'Berisi', 'Penuh'],

                datasets: [{
                    data: [kosong, berisi, penuh],

                    backgroundColor: [
                        '#14b8a6',
                        '#eab308',
                        '#ef4444'
                    ],

                    borderWidth: 0
                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }
                },

                cutout: '70%'
            }
        });

        // =========================
        // BAR CHART
        // =========================
        const barCtx = document.getElementById('barChart');

        new Chart(barCtx, {

            type: 'bar',

            data: {

                labels: ['Kosong', 'Berisi', 'Penuh'],

                datasets: [{

                    label: 'Jumlah Kontainer',

                    data: [kosong, berisi, penuh],

                    backgroundColor: [
                        '#14b8a6',
                        '#eab308',
                        '#ef4444'
                    ],

                    borderRadius: 12
                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        display: false
                    }
                },

                scales: {

                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>

@endsection
@extends('user.header')


@section('content')

    <!-- MAIN -->
    <main class="pt-0 px-4 sm:px-6 lg:px-8 pb-10">

        <!-- TITLE -->
        <div class="mb-8">

            <h1 class="text-4xl font-bold text-primary mb-2">
                Monitoring Tong Sampah IoT
            </h1>

            <p class="text-on-surface-variant">
                Monitoring real-time kapasitas tong sampah pintar
            </p>

        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">

            <!-- TOTAL -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Total Tong Sampah
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->count() }}
                </h4>

            </div>

            <!-- PENUH -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Penuh
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 81)->count() }}
                </h4>

            </div>

            <!-- BERISI -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Berisi
                </p>

                <h4 class="text-4xl font-bold text-yellow-700">
                    {{ $containers->whereBetween('persen', [11, 80])->count() }}
                </h4>

            </div>

            <!-- KOSONG -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Kosong
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->where('persen', '<=', 10)->count() }}
                </h4>

            </div>

            <!-- BUTUH PENGOSONGAN -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Butuh Pengosongan
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 90)->count() }}
                </h4>

            </div>
            <div class="flex gap-2">

                {{-- <a href="/petugas/monitoring-log"
                    class="bg-slate-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-800 transition flex items-center gap-2">

                    <span class="material-symbols-outlined text-[18px]">
                        history
                    </span>

                    History

                </a> --}}

                <a href="/export-excel"
                    class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition flex items-center gap-2">

                    <span class="material-symbols-outlined text-[18px]">
                        download
                    </span>

                    Export Excel

                </a>

            </div>

        </div>
        

        <!-- TABLE -->
        <div class="flex justify-between items-center px-6 py-4 border-b">


            <table class="w-full text-left border-collapse">

                <!-- THEAD -->
                <thead>

                    <tr class="bg-surface-container-low border-b border-outline-variant">

                        <th class="px-6 py-4 text-xs uppercase">
                            No
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Kode
                        </th>
                        <th class="px-6 py-4 text-xs uppercase">
                            Kecamatan
                        </th>
                        <th class="px-6 py-4 text-xs uppercase">
                            Kelurahan
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Lokasi
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Status
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            System Status
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Persentase
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Baterai
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Koordinat
                        </th>
                        <th class="px-6 py-4 text-xs uppercase">
                            Peta
                        </th>

                        <th class="px-6 py-4 text-xs uppercase">
                            Update
                        </th>

                    </tr>

                </thead>

                <!-- TBODY -->
                <tbody class="divide-y divide-outline-variant/30">

                    @forelse ($containers as $container)

                        @php

                            if ($container->persen >= 81) {

                                $status = 'Penuh';

                                $statusColor = 'bg-red-600 text-white';

                                $barColor = 'bg-red-600';

                                $textColor = 'text-red-600';

                            } elseif ($container->persen >= 11) {

                                $status = 'Berisi';

                                $statusColor = 'bg-yellow-200 text-yellow-800';

                                $barColor = 'bg-yellow-600';

                                $textColor = 'text-yellow-700';

                            } else {

                                $status = 'Kosong';

                                $statusColor = 'bg-green-200 text-green-800';

                                $barColor = 'bg-green-600';

                                $textColor = 'text-green-700';

                            }

                        @endphp

                        <tr class="hover:bg-surface-bright transition-colors">

                            <!-- NOMOR -->
                            <td class="px-6 py-4">

                                {{ $loop->iteration }}

                            </td>

                            <!-- KODE -->
                            <td class="px-6 py-4 font-semibold text-primary">

                                {{ $container->kode_containers }}

                            </td>
                            <td class="px-6 py-4 font-semibold text-primary">

                                {{ $container->kecamatan->nama_kecamatan ?? '-' }}

                            </td>
                            <td class="px-6 py-4 font-semibold text-primary">

                                {{ $container->kelurahan->nama_kelurahan ?? '-' }}

                            </td>


                            <!-- LOKASI -->
                            <td class="px-6 py-4">

                                {{ $container->nama_lokasi }}

                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4">

                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">

                                    {{ $status }}

                                </span>

                            </td>

                            <!-- SYSTEM STATUS -->
                            <td class="px-6 py-4">

                                @php
                                    $systemStatus = $container->status_system ?? 'Offline';
                                    $systemColor = match ($systemStatus) {
                                        'Online' => 'bg-emerald-600 text-white',
                                        default => 'bg-gray-500 text-white',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $systemColor }}">
                                    {{ $systemStatus }}
                                </span>

                            </td>

                            <!-- PERSENTASE -->
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-[120px] h-2 bg-gray-200 rounded-full overflow-hidden">

                                        <div class="h-full {{ $barColor }}" style="width: {{ $container->persen }}%">
                                        </div>

                                    </div>

                                    <span class="font-bold {{ $textColor }}">

                                        {{ $container->persen }}%

                                    </span>

                                </div>

                            </td>

                            <!-- BATERAI -->
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <span class="material-symbols-outlined text-green-600">
                                        battery_full
                                    </span>

                                    <span class="font-bold">

                                        {{ $container->baterai }}%

                                    </span>

                                </div>

                            </td>

                            <!-- KOORDINAT -->
                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ $container->latitude }},
                                {{ $container->longitude }}

                            </td>
                            <td class="px-6 py-4">

                                <a href="https://www.google.com/maps?q={{ $container->latitude }},{{ $container->longitude }}"
                                    target="_blank"
                                    class="flex items-center gap-2 text-primary hover:text-secondary font-semibold transition-all">

                                    <span class="material-symbols-outlined text-[20px]">
                                        map
                                    </span>

                                    Maps

                                </a>

                            </td>

                            <!-- UPDATE -->
                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ \Carbon\Carbon::parse($container->updated_at)->diffForHumans() }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-10 text-gray-500">

                                Tidak ada data container

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        </div>

    </main>
@endsection
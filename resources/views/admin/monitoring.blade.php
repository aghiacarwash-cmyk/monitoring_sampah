@extends('admin.app')

@section('title', 'Daftar Kontainer Sampah')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-lg font-medium text-gray-800">Data Riwayat Monitoring</h1>
    </div>
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm text-left">
                <thead>
                    <tr
                        class="bg-gray-50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Kecamatan</th>
                        <th class="px-4 py-3">Kelurahan</th>
                        <th class="px-4 py-3">Persentase</th>
                        <th class="px-4 py-3">Baterai</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Latitude</th>
                        <th class="px-4 py-3">Longitude</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($logs as $index => $log)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 text-gray-400">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($log->waktu)->format('d-m-Y H:i:s') }}
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $log->kode_container }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $log->kecamatan->nama_kecamatan ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $log->kelurahan->nama_kelurahan ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">

                                    <div class="w-16 h-1.5 bg-gray-200 rounded-full overflow-hidden">

                                        <div class="h-full rounded-full
                                    {{ $log->persen >= 80 ? 'bg-red-500' : ($log->persen >= 50 ? 'bg-yellow-400' : 'bg-teal-500') }}"
                                            style="width: {{ $log->persen }}%">
                                        </div>

                                    </div>

                                    <span class="text-gray-600 text-xs">
                                        {{ $log->persen }}%
                                    </span>

                                </div>
                            </td>

                            <td class="px-4 py-3">

                                <div class="flex items-center gap-1">

                                    <svg class="w-3.5 h-3.5
                            {{ $log->baterai >= 50 ? 'text-teal-500' : ($log->baterai >= 20 ? 'text-yellow-400' : 'text-red-500') }}"
                                        fill="currentColor" viewBox="0 0 24 24">

                                        <path
                                            d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z" />

                                    </svg>

                                    <span class="text-xs text-gray-600">
                                        {{ $log->baterai }}%
                                    </span>

                                </div>

                            </td>

                            <td class="px-4 py-3">

                                @php
                                    $statusColor = match ($log->status) {
                                        'Penuh' => 'bg-red-100 text-red-700',
                                        'Berisi' => 'bg-yellow-100 text-yellow-700',
                                        'Kosong' => 'bg-teal-100 text-teal-700',
                                        default => 'bg-gray-100 text-gray-500',
                                    };
                                @endphp

                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ $log->status }}
                                </span>

                            </td>

                            <td class="px-4 py-3 text-gray-400 text-xs font-mono">
                                {{ $log->latitude }}
                            </td>

                            <td class="px-4 py-3 text-gray-400 text-xs font-mono">
                                {{ $log->longitude }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10" class="px-4 py-12 text-center text-gray-400 text-sm">

                                <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                                    stroke-width="1" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25" />

                                </svg>

                                Belum ada data monitoring.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>
@endsection
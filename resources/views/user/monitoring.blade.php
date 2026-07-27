@extends('user.header')


@section('content')
    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">


        <div class="mb-8">

            <h1 class="text-4xl font-bold text-primary mb-2 px-6">
                Data Riwayat Monitoring
            </h1>
        </div>

        <div class="flex justify-between items-center px-6 py-2 border-">

            <table class="w-full text-left border-collapse">

                <thead class="bg-gray-100 uppercase text-sm">

                    <tr>

                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Kecamatan</th>
                        <th class="px-4 py-3">Kelurahan</th>
                        <th class="px-4 py-3">Persentase</th>
                        <th class="px-4 py-3">Baterai</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Koordinat</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($logs as $index => $log)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($log->waktu)->format('d-m-Y H:i:s') }}
                            </td>

                            <td class="px-4 py-3 font-semibold text-primary">
                                {{ $log->kode_container }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $log->kecamatan->nama_kecamatan ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $log->kelurahan->nama_kelurahan ?? '-' }}
                            </td>

                            <td class="px-4 py-3 font-semibold">
                                {{ $log->persen }}%
                            </td>

                            <td class="px-4 py-3">
                                {{ $log->baterai }}%
                            </td>

                            <td class="px-4 py-3">

                                @if($log->status == 'Kosong')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Kosong
                                    </span>

                                @elseif($log->status == 'Berisi')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Berisi
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Penuh
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3">
                                {{ $log->latitude }},
                                {{ $log->longitude }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
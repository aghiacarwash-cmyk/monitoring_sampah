<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Container;

new class extends Component
{
    public $containers;

    public function mount()
    {
        $this->containers = Container::with([
            'kecamatan',
            'kelurahan'
        ])->get();
    }

    #[On('echo:monitoring-channel,.data.updated')]
    public function handleUpdate()
    {
        $this->containers = Container::with([
            'kecamatan',
            'kelurahan'
        ])->get();
    }
};
?>

<div>
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

        </div>


        <!-- EXPORT -->
        <div class="flex justify-end mb-6">

            <a
                href="/export-excel"
                class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition flex items-center gap-2"
            >

                <span class="material-symbols-outlined text-[18px]">
                    download
                </span>

                Export Excel

            </a>

        </div>


        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow-sm border border-outline-variant overflow-hidden">

            <div class="overflow-x-auto">

                <table class="min-w-[1900px] w-full text-left border-collapse">

                    <!-- THEAD -->
                    <thead>

                        <tr class="bg-surface-container-low border-b border-outline-variant">

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[70px]">
                                No
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[130px]">
                                Kode
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[180px]">
                                Kecamatan
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[180px]">
                                Kelurahan
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[400px]">
                                Lokasi
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[130px]">
                                Status
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[160px]">
                                System Status
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[220px]">
                                Persentase
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[130px]">
                                Baterai
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[220px]">
                                Koordinat
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[120px]">
                                Peta
                            </th>

                            <th class="px-6 py-4 text-xs uppercase whitespace-nowrap w-[180px]">
                                Update
                            </th>

                        </tr>

                    </thead>


                    <!-- TBODY -->
                    <tbody class="divide-y divide-outline-variant/30">

                        @forelse ($containers as $container)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | STATUS SAMPAH
                                |--------------------------------------------------------------------------
                                */

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


                                /*
                                |--------------------------------------------------------------------------
                                | SYSTEM STATUS
                                |--------------------------------------------------------------------------
                                */

                                $systemStatus = $container->status_system ?? 'Offline';

                                $systemColor = match ($systemStatus) {

                                    'Online' => 'bg-emerald-600 text-white',

                                    default => 'bg-gray-500 text-white',

                                };


                                /*
                                |--------------------------------------------------------------------------
                                | PERSENTASE
                                |--------------------------------------------------------------------------
                                */

                                $persen = max(
                                    0,
                                    min(
                                        100,
                                        (float) ($container->persen ?? 0)
                                    )
                                );

                            @endphp


                            <tr class="hover:bg-surface-bright transition-colors">


                                <!-- NOMOR -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    {{ $loop->iteration }}

                                </td>


                                <!-- KODE -->
                                <td class="px-6 py-4 font-semibold text-primary whitespace-nowrap">

                                    {{ $container->kode_containers ?? '-' }}

                                </td>


                                <!-- KECAMATAN -->
                                <td class="px-6 py-4 font-semibold text-primary whitespace-nowrap">

                                    {{ $container->kecamatan?->nama_kecamatan ?? '-' }}

                                </td>


                                <!-- KELURAHAN -->
                                <td class="px-6 py-4 font-semibold text-primary whitespace-nowrap">

                                    {{ $container->kelurahan?->nama_kelurahan ?? '-' }}

                                </td>


                                <!-- LOKASI -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    {{ $container->nama_lokasi ?? '-' }}

                                </td>


                                <!-- STATUS -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">

                                        {{ $status }}

                                    </span>

                                </td>


                                <!-- SYSTEM STATUS -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $systemColor }}">

                                        {{ $systemStatus }}

                                    </span>

                                </td>


                                <!-- PERSENTASE -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-3">

                                        <div class="w-[120px] h-2 bg-gray-200 rounded-full overflow-hidden">

                                            <div
                                                class="h-full {{ $barColor }}"
                                                style="width: {{ $persen }}%"
                                            ></div>

                                        </div>

                                        <span class="font-bold {{ $textColor }}">

                                            {{ $persen }}%

                                        </span>

                                    </div>

                                </td>


                                <!-- BATERAI -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="flex items-center gap-2">

                                        <span class="material-symbols-outlined text-green-600">
                                            battery_full
                                        </span>

                                        <span class="font-bold">

                                            {{ $container->baterai ?? 0 }}%

                                        </span>

                                    </div>

                                </td>


                                <!-- KOORDINAT -->
                                <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">

                                    {{ $container->latitude ?? '-' }},
                                    {{ $container->longitude ?? '-' }}

                                </td>


                                <!-- PETA -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    @if ($container->latitude && $container->longitude)

                                        <a
                                            href="https://www.google.com/maps?q={{ $container->latitude }},{{ $container->longitude }}"
                                            target="_blank"
                                            class="flex items-center gap-2 text-primary hover:text-secondary font-semibold transition-all"
                                        >

                                            <span class="material-symbols-outlined text-[20px]">
                                                map
                                            </span>

                                            Maps

                                        </a>

                                    @else

                                        <span class="text-gray-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <!-- UPDATE -->
                                <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">

                                    @if ($container->updated_at)

                                        {{ \Carbon\Carbon::parse($container->updated_at)->diffForHumans() }}

                                    @else

                                        -

                                    @endif

                                </td>


                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="12"
                                    class="text-center py-10 text-gray-500"
                                >

                                    Tidak ada data container

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>
</div>
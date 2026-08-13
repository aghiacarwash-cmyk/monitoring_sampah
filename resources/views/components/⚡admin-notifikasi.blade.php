<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Container;

new class extends Component
{
    public $warningPenuh;
    public $warningBaterai;
    public $warningSensor;
    public $totalNotif;

    public function mount()
    {
        $this->loadData();
    }

    #[On('echo:monitoring-channel,.data.updated')]
    public function refreshNotif()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->warningPenuh = Container::with(['kecamatan', 'kelurahan'])
            ->where('persen', '>=', 80)
            ->get();

        $this->warningBaterai = Container::with(['kecamatan', 'kelurahan'])
            ->where('baterai', '<=', 20)
            ->get();

        $this->warningSensor = Container::with(['kecamatan', 'kelurahan'])
            ->where(function ($q) {
                $q->where('notif_sensor1', true)
                    ->orWhere('notif_sensor2', true)
                    ->orWhere('notif_sensor3', true)
                    ->orWhere('notif_sensor4', true);
            })->get();

        $this->totalNotif = $this->warningPenuh->count()
            + $this->warningBaterai->count()
            + $this->warningSensor->count();
    }
}; ?>

<div>
    <!-- NOTIFICATION -->
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open"
            class="relative p-2 rounded-full hover:bg-surface-container-highest transition-colors active:scale-95">
            <span class="material-symbols-outlined">notifications</span>
            @if($totalNotif > 0)
                <span
                    class="absolute top-1 right-1 min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">
                    {{ $totalNotif }}
                </span>
            @endif
        </button>

        <!-- Dropdown — full width di mobile -->
        <div x-show="open" @click.away="open = false" x-transition
            class="fixed md:absolute left-2 right-2 md:left-auto md:right-0 top-[68px] md:top-auto md:mt-3 md:w-[400px] bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden z-50">

            <div class="px-4 py-3 border-b bg-gray-50 flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm">Notifikasi Kontainer</h3>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-400">{{ $totalNotif }} peringatan</span>
                    <button @click="open = false" class="p-1 rounded-full hover:bg-gray-200 md:hidden">
                        <span class="material-symbols-outlined text-gray-500" style="font-size:18px">close</span>
                    </button>
                </div>
            </div>

            <div class="max-h-[60vh] md:max-h-[450px] overflow-y-auto divide-y divide-gray-100">
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-red-500 text-base">delete</span>
                        <h4 class="font-semibold text-red-600 text-sm">Kepenuhan ≥ 80%</h4>
                        <span
                            class="ml-auto text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full">{{ $warningPenuh->count() }}</span>
                    </div>
                    @forelse($warningPenuh as $item)
                        <div class="mb-2 p-3 rounded-xl bg-red-50 border border-red-100">
                            <div class="flex justify-between items-start gap-2">
                                <div class="min-w-0">
                                    <div class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</div>
                                    <div class="text-xs text-gray-600 truncate">{{ $item->nama_lokasi }}</div>
                                    @if($item->kecamatan)
                                        <div class="text-xs text-gray-400">{{ $item->kecamatan->nama_kecamatan }}</div>
                                    @endif
                                </div>
                                <div class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold flex-shrink-0">
                                    {{ $item->persen }}%</div>
                            </div>
                            <div class="mt-2 h-1.5 bg-red-100 rounded-full overflow-hidden">
                                <div class="h-full bg-red-500 rounded-full" style="width: {{ $item->persen }}%"></div>
                            </div>
                            @if($item->latitude && $item->longitude)
                                <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                    target="_blank"
                                    class="mt-2 flex items-center justify-center gap-1 text-xs font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg py-1.5 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:14px">location_on</span>
                                    Lihat Lokasi
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="text-xs text-gray-400 bg-gray-50 p-3 rounded-xl text-center">Tidak ada kontainer
                            penuh</div>
                    @endforelse
                </div>

                <div class="p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-yellow-500 text-base">battery_alert</span>
                        <h4 class="font-semibold text-yellow-600 text-sm">Baterai ≤ 20%</h4>
                        <span
                            class="ml-auto text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">{{ $warningBaterai->count() }}</span>
                    </div>
                    @forelse($warningBaterai as $item)
                        <div class="mb-2 p-3 rounded-xl bg-yellow-50 border border-yellow-100">
                            <div class="flex justify-between items-start gap-2">
                                <div class="min-w-0">
                                    <div class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</div>
                                    <div class="text-xs text-gray-600 truncate">{{ $item->nama_lokasi }}</div>
                                    @if($item->kecamatan)
                                        <div class="text-xs text-gray-400">{{ $item->kecamatan->nama_kecamatan }}</div>
                                    @endif
                                </div>
                                <div
                                    class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold flex-shrink-0">
                                    {{ $item->baterai }}%</div>
                            </div>
                            <div class="mt-2 h-1.5 bg-yellow-100 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $item->baterai }}%">
                                </div>
                            </div>
                            @if($item->latitude && $item->longitude)
                                <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                    target="_blank"
                                    class="mt-2 flex items-center justify-center gap-1 text-xs font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg py-1.5 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:14px">location_on</span>
                                    Lihat Lokasi
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="text-xs text-gray-400 bg-gray-50 p-3 rounded-xl text-center">Tidak ada baterai
                            lemah</div>
                    @endforelse
                </div>

                <!-- SECTION GANGGUAN SENSOR -->
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-orange-500 text-base">sensors_off</span>
                        <h4 class="font-semibold text-orange-600 text-sm">Gangguan Sensor</h4>
                        <span
                            class="ml-auto text-xs bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full">{{ $warningSensor->count() }}</span>
                    </div>
                    @forelse($warningSensor as $item)
                        @php
                            $sensorRusak = [];
                            if ($item->notif_sensor1) $sensorRusak[] = 'Sensor 1';
                            if ($item->notif_sensor2) $sensorRusak[] = 'Sensor 2';
                            if ($item->notif_sensor3) $sensorRusak[] = 'Sensor 3';
                            if ($item->notif_sensor4) $sensorRusak[] = 'Sensor 4';
                        @endphp
                        <div class="mb-2 p-3 rounded-xl bg-orange-50 border border-orange-100">
                            <div class="flex justify-between items-start gap-2">
                                <div class="min-w-0">
                                    <div class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</div>
                                    <div class="text-xs text-gray-600 truncate">{{ $item->nama_lokasi }}</div>
                                    @if($item->kecamatan)
                                        <div class="text-xs text-gray-400">{{ $item->kecamatan->nama_kecamatan }}</div>
                                    @endif
                                </div>
                                <div
                                    class="bg-orange-500 text-white text-xs px-2 py-1 rounded-full font-bold flex-shrink-0">
                                    {{ count($sensorRusak) }} error
                                </div>
                            </div>
                            <div class="mt-2 text-xs text-orange-700 bg-orange-100 rounded-lg px-2 py-1.5">
                                {{ implode(', ', $sensorRusak) }} mengalami gangguan
                            </div>
                            @if($item->latitude && $item->longitude)
                                <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                    target="_blank"
                                    class="mt-2 flex items-center justify-center gap-1 text-xs font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg py-1.5 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:14px">location_on</span>
                                    Lihat Lokasi
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="text-xs text-gray-400 bg-gray-50 p-3 rounded-xl text-center">Tidak ada gangguan
                            sensor</div>
                    @endforelse
                </div>
                <!-- END SECTION -->
            </div>

            <div class="px-4 py-3 border-t bg-gray-50 text-center">
                <a href="/petugas/monitoring-log" class="text-xs text-teal-600 hover:underline font-medium">Lihat semua
                    history →</a>
            </div>
        </div>
    </div>
</div>
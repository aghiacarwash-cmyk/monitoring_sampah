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
    }};
?>

<div>
    <table class="w-full text-left border-collapse">

                    <thead>
                        <tr
                            class="bg-surface-container-low text-on-surface-variant text-xs border-b border-outline-variant">

                            <th class="px-6 py-4">Nomor</th>
                            <th class="px-6 py-4">Kode Kontainer</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">System Status</th>

                            <th class="px-6 py-4">Persentase</th>
                            <th class="px-6 py-4">Baterai</th>
                            <th class="px-6 py-4">Update</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">

                        @forelse ($containers as $container)

                            <tr class="hover:bg-surface-container-low transition-colors">

                                {{-- Nomor --}}
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Kode --}}
                                <td class="px-6 py-4">
                                    {{ $container->kode_containers }}
                                </td>

                                {{-- Lokasi --}}
                                <td class="px-6 py-4">
                                    {{ $container->nama_lokasi }}
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @php
                                        if ($container->persen >= 81) {
                                            $status = 'Penuh';
                                            $color = 'bg-red-600';

                                        } elseif ($container->persen >= 11) {
                                            $status = 'Berisi';
                                            $color = 'bg-yellow-600';

                                        } else {
                                            $status = 'Kosong';
                                            $color = 'bg-green-600';
                                        }
                                    @endphp

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full {{ $color }} text-white text-xs font-bold">
                                        {{ $status }}
                                    </span>

                                </td>
                                  <td class="px-6 py-4">

                                    @php
                                        $systemStatus = $container->status_system ?? 'Offline';
                                        $systemBg = match($systemStatus) {
                                            'Online' => 'bg-emerald-600 text-white',
                                            default => 'bg-gray-500 text-white',
                                        };
                                    @endphp

                                    <span class="inline-flex items-center px-3 py-1 rounded-full font-bold text-[12px] {{ $systemBg }}">
                                        {{ $systemStatus }}
                                    </span>

                                </td>

                                {{-- Persentase --}}
                                <td class="px-6 py-4">

                                    <div class="w-full bg-surface-container-high h-2.5 rounded-full overflow-hidden">

                                        <div class="bg-primary h-full" style="width: {{ $container->persen }}%">
                                        </div>

                                    </div>

                                    <span class="text-xs font-bold mt-1 inline-block">
                                        {{ $container->persen }}%
                                    </span>

                                </td>

                                {{-- Baterai --}}
                                <td class="px-6 py-4">
                                    {{ $container->baterai }}%
                                </td>

                                {{-- Update --}}
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($container->updated_at)->diffForHumans() }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-6">
                                    Data container belum ada
                                </td>
                            </tr>

                        @endforelse

                    </tbody>


                </table>
</div>
<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Container;
new class extends Component
{
    // 1. Deklarasikan properti public di sini (di luar method mount)
    public $containers;

    // 2. Baru method mount di bawahnya
    public function mount()
    {
        $this->loadContainers();
    }

    #[On('echo:monitoring-channel,.data.updated')]
    public function handleUpdate()
    {
        $this->loadContainers();
    }

    public function loadContainers()
    {
        $this->containers = Container::with([
            'kecamatan',
            'kelurahan'
        ])->get();
    }
};
?>

<div>
    <table class="w-full text-xs sm:text-sm text-left">
        <thead>
          <tr class="bg-gray-50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Kode</th>
            <th class="px-4 py-3">Nama Lokasi</th>
            <th class="px-4 py-3">Kecamatan</th>
            <th class="px-4 py-3">Kelurahan</th>
            <th class="px-4 py-3">Kapasitas</th>
            <th class="px-4 py-3">Persen</th>
            <th class="px-4 py-3">Baterai</th>
            <th class="px-4 py-3">Latitude</th>
            <th class="px-4 py-3">Longitude</th>
            <th class="px-4 py-3 text-center">Maps</th> {{-- Header Kolom Baru --}}
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">System Status</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($containers as $index => $container)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>

              <td class="px-4 py-3 font-medium text-gray-800">{{ $container->kode_containers }}</td>

              <td class="px-4 py-3 text-gray-600">{{ $container->nama_lokasi }}</td>

              <td class="px-4 py-3 text-gray-600">{{ $container->kecamatan->nama_kecamatan ?? '-' }}</td>

              <td class="px-4 py-3 text-gray-600">{{ $container->kelurahan->nama_kelurahan ?? '-' }}</td>

              <td class="px-4 py-3 text-gray-600">{{ $container->kapasitas }} L</td>

              <td class="px-4 py-3">
                <div class="flex items-center gap-2">
                  <div class="w-16 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full rounded-full {{ $container->persen >= 80 ? 'bg-red-500' : ($container->persen >= 50 ? 'bg-yellow-400' : 'bg-teal-500') }}"
                      style="width: {{ $container->persen }}%"></div>
                  </div>
                  <span class="text-gray-600 text-xs">{{ $container->persen }}%</span>
                </div>
              </td>

              <td class="px-4 py-3">
                <div class="flex items-center gap-1">
                  <svg class="w-3.5 h-3.5 {{ $container->baterai >= 50 ? 'text-teal-500' : ($container->baterai >= 20 ? 'text-yellow-400' : 'text-red-500') }}"
                    fill="currentColor" viewBox="0 0 24 24"><path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/></svg>
                  <span class="text-xs text-gray-600">{{ $container->baterai }}%</span>
                </div>
              </td>

              <td class="px-4 py-3 text-gray-400 text-xs font-mono">{{ $container->latitude }}</td>

              <td class="px-4 py-3 text-gray-400 text-xs font-mono">{{ $container->longitude }}</td>

              {{-- Kolom Google Maps Baru --}}
              <td class="px-4 py-3 text-center">
                @if ($container->latitude && $container->longitude)
                  <a href="https://www.google.com/maps/search/?api=1&query={{ $container->latitude }},{{ $container->longitude }}" 
                     target="_blank" 
                     class="inline-flex items-center justify-center p-1.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-lg transition" 
                     title="Buka Lokasi di Google Maps">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                  </a>
                @else
                  <span class="text-gray-300 text-xs">—</span>
                @endif
              </td>

              <td class="px-4 py-3">
                @php
                  $statusColor = match($container->status) {
                    'Penuh'  => 'bg-red-100 text-red-700',
                    'Berisi' => 'bg-yellow-100 text-yellow-700',
                    'Kosong' => 'bg-teal-100 text-teal-700',
                    default  => 'bg-gray-100 text-gray-500',
                  };
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                  {{ $container->status }}
                </span>
              </td>

              <td class="px-4 py-3">
                @php
                  $systemStatus = $container->status_system ?? 'Offline';
                  $systemStatusColor = match($systemStatus) {
                    'Online'  => 'bg-emerald-100 text-emerald-700',
                    'Offline' => 'bg-gray-100 text-gray-600',
                    default   => 'bg-gray-100 text-gray-600',
                  };
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $systemStatusColor }}">
                  {{ $systemStatus }}
                </span>
              </td>

              <td class="px-4 py-3">
                <div class="flex items-center justify-center gap-2">
                  {{-- Edit --}}
                  <a href="{{ route('admin.kontainer.edit', $container->id_container) }}"
                    class="p-1.5 rounded-lg text-gray-400 hover:text-teal-600 hover:bg-teal-50 transition" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('admin.kontainer.destroy',$container->id_container) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kontainer {{ $container->kode_containers }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition" title="Hapus">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="13" class="px-4 py-12 text-center text-gray-400 text-sm">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                Belum ada kontainer terdaftar
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
</div>
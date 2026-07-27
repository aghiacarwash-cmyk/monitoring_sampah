<!-- TopAppBar -->
<header
    class="flex justify-between items-center w-full px-margin-page h-16 bg-surface border-b border-outline-variant sticky top-0 z-40">

    <!-- LEFT -->
    <div class="flex items-center gap-stack-md">
        <h2 class="font-h2 text-h2 text-primary">Clean IoT</h2>
        <div class="relative ml-stack-lg">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">search</span>
            <input class="pl-10 pr-4 py-2 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary text-body-md w-64 transition-all"
                placeholder="Cari lokasi atau ID bin..." type="text" />
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        @php
            use App\Models\Container;
            $warningPenuh   = Container::with(['kecamatan','kelurahan'])->where('persen', '>=', 80)->get();
            $warningBaterai = Container::with(['kecamatan','kelurahan'])->where('baterai', '<=', 20)->get();
            $totalNotif     = $warningPenuh->count() + $warningBaterai->count();
        @endphp

        <!-- NOTIFICATION -->
        <div x-data="{ open: false }" class="relative">

            <button @click="open = !open"
                class="relative p-2 rounded-full hover:bg-surface-container-highest transition-colors active:scale-95 duration-150">
                <span class="material-symbols-outlined">notifications</span>
                @if($totalNotif > 0)
                    <span class="absolute top-1 right-1 min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">
                        {{ $totalNotif }}
                    </span>
                @endif
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 mt-3 w-[420px] bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden z-50">

                <!-- Header -->
                <div class="px-4 py-3 border-b bg-gray-50 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-700">Notifikasi Kontainer</h3>
                    <span class="text-xs text-gray-400">{{ $totalNotif }} peringatan</span>
                </div>

                <div class="max-h-[480px] overflow-y-auto divide-y divide-gray-100">

                    {{-- ── KEPENUHAN ≥ 80% ── --}}
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-red-500 text-base">delete</span>
                            <h4 class="font-semibold text-red-600 text-sm">Kepenuhan ≥ 80%</h4>
                            <span class="ml-auto text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-medium">
                                {{ $warningPenuh->count() }} kontainer
                            </span>
                        </div>

                        @forelse($warningPenuh as $item)
                            <div class="mb-2 p-3 rounded-xl bg-red-50 border border-red-100">
                                <div class="flex justify-between items-start gap-3">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</span>
                                            <span class="text-xs px-1.5 py-0.5 rounded bg-red-100 text-red-700">
                                                {{ $item->status_system }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-600 mt-0.5 truncate">{{ $item->nama_lokasi }}</div>
                                        @if($item->kecamatan)
                                            <div class="text-xs text-gray-400 mt-0.5">{{ $item->kecamatan->nama_kecamatan }}</div>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-0 text-right">
                                        <div class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                            {{ $item->persen }}%
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">penuh</div>
                                    </div>
                                </div>
                                {{-- Progress bar --}}
                                <div class="mt-2 h-1.5 bg-red-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-red-500 rounded-full" style="width: {{ $item->persen }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-400 bg-gray-50 p-3 rounded-xl text-center">
                                Tidak ada kontainer penuh
                            </div>
                        @endforelse
                    </div>

                    {{-- ── BATERAI ≤ 20% ── --}}
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-yellow-500 text-base">battery_alert</span>
                            <h4 class="font-semibold text-yellow-600 text-sm">Baterai ≤ 20%</h4>
                            <span class="ml-auto text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full font-medium">
                                {{ $warningBaterai->count() }} kontainer
                            </span>
                        </div>

                        @forelse($warningBaterai as $item)
                            <div class="mb-2 p-3 rounded-xl bg-yellow-50 border border-yellow-100">
                                <div class="flex justify-between items-start gap-3">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</span>
                                            <span class="text-xs px-1.5 py-0.5 rounded bg-yellow-100 text-yellow-700">
                                                {{ $item->status_system }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-600 mt-0.5 truncate">{{ $item->nama_lokasi }}</div>
                                        @if($item->kecamatan)
                                            <div class="text-xs text-gray-400 mt-0.5">{{ $item->kecamatan->nama_kecamatan }}</div>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-0 text-right">
                                        <div class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                                            {{ $item->baterai }}%
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1">baterai</div>
                                    </div>
                                </div>
                                {{-- Progress bar --}}
                                <div class="mt-2 h-1.5 bg-yellow-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $item->baterai }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-400 bg-gray-50 p-3 rounded-xl text-center">
                                Tidak ada baterai lemah
                            </div>
                        @endforelse
                    </div>

                </div>

                <!-- Footer -->
                <div class="px-4 py-3 border-t bg-gray-50 text-center">
                    <a href="/admin/monitoring-log" class="text-xs text-teal-600 hover:underline font-medium">
                        Lihat semua riwayat →
                    </a>
                </div>

            </div>
        </div>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="p-2 rounded-full hover:bg-error-container transition-colors active:scale-95 duration-150">
                <span class="material-symbols-outlined text-error">logout</span>
            </button>
        </form>

        <!-- PROFILE -->
        <div class="flex items-center gap-3 ml-2">
            <div class="h-10 w-10 rounded-full overflow-hidden border border-outline-variant bg-gray-100">
                <img src="{{ session('foto') ? asset('storage/' . session('foto')) : asset('foto_petugas/default-user.png') }}"
                    alt="Foto" class="w-full h-full object-cover">
            </div>
            <div class="hidden md:block">
                <div class="text-sm font-semibold text-gray-800 leading-none">{{ session('nama_lengkap') }}</div>
                <div class="text-xs text-gray-500 mt-1">Petugas Kebersihan</div>
            </div>
        </div>

    </div>
</header>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@extends('admin.app')

@section('title', 'Tambah Kontainer Sampah')

@section('content')
        <div class="min-h-screen bg-gray-50 p-7">
 
        <div class="mb-6">
            <h1 class="text-lg font-medium text-gray-800">Tambah Kontainer Sampah</h1>
            <p class="text-sm text-gray-500 mt-1">Lengkapi semua data untuk mendaftarkan kontainer baru</p>
        </div>
 
        <div class="bg-white border border-gray-200 rounded-xl p-6 max-w-2xl">
            <form action="{{ route('admin.kontainer.store') }}" method="POST">
                @csrf
 
                {{-- Identitas --}}
                <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mb-3 pb-2 border-b border-teal-100">Identitas Kontainer</p>
                <div class="grid grid-cols-2 gap-4 mb-4">
 
                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kode Kontainer</label>
                        <input type="text" name="kode_containers" value="{{ old('kode_containers') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: KNT-001">
                        @error('kode_containers') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
 
                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kapasitas (liter)</label>
                        <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" min="1"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: 500">
                        @error('kapasitas') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
 
                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Nama Lokasi</label>
                        <input type="text" name="nama_lokasi" value="{{ old('nama_lokasi') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: Pasar Pagi Lubuk Alung">
                        @error('nama_lokasi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
 
                </div>
 
                {{-- Wilayah --}}
                <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mb-3 pb-2 border-b border-teal-100">Wilayah</p>
                <div class="grid grid-cols-2 gap-4 mb-4">
 
                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan" onchange="filterKelurahan(this.value)"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
                            <option value="">— Pilih Kecamatan —</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id_kecamatan }}"
                                    {{ old('id_kecamatan') == $kecamatan->id_kecamatan ? 'selected' : '' }}>
                                    {{ $kecamatan->nama_kecamatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kecamatan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
 
                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kelurahan / Nagari</label>
                        <select name="id_kelurahan" id="id_kelurahan"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
                            <option value="">— Pilih Kelurahan —</option>
                            @foreach ($kelurahans as $kelurahan)
                                <option value="{{ $kelurahan->id_kelurahan }}"
                                    data-kecamatan="{{ $kelurahan->id_kecamatan }}"
                                    {{ old('id_kelurahan') == $kelurahan->id_kelurahan ? 'selected' : '' }}>
                                    {{ $kelurahan->nama_kelurahan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kelurahan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
 
                </div>
 
                <hr class="border-gray-100 my-5">
 
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Simpan Kontainer
                </button>
 
            </form>
        </div>
    </div>
 
    <script>
        function filterKelurahan(kecamatanId) {
            const select = document.getElementById('id_kelurahan');
            select.value = '';
            select.querySelectorAll('option[data-kecamatan]').forEach(function(opt) {
                opt.style.display = !kecamatanId || opt.dataset.kecamatan == kecamatanId ? '' : 'none';
            });
        }
 
        // Jalankan filter saat page load jika ada old value
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanVal = document.getElementById('id_kecamatan').value;
            if (kecamatanVal) filterKelurahan(kecamatanVal);
        });
    </script>
@endsection
    {{-- <div class="min-h-screen bg-gray-50 p-7">

        <div class="mb-6">
            <h1 class="text-lg font-medium text-gray-800">Tambah Kontainer Sampah</h1>
            <p class="text-sm text-gray-500 mt-1">Lengkapi semua data untuk mendaftarkan kontainer baru</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 max-w-2xl">
            <form action="" method="POST" id="formKontainer">
                @csrf

                <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mb-3 pb-2 border-b border-teal-100">
                    Identitas Kontainer</p>
                <div class="grid grid-cols-2 gap-4 mb-2">

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kode Kontainer</label>
                        <input type="text" name="kode_containers" value="{{ old('kode_containers') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: KNT-001">
                        @error('kode_containers') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kapasitas (liter)</label>
                        <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" min="1"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: 500">
                        @error('kapasitas') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Nama Lokasi</label>
                        <input type="text" name="nama_lokasi" value="{{ old('nama_lokasi') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: Pasar Pagi Lubuk Alung">
                        @error('nama_lokasi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>

                <p
                    class="text-xs font-medium text-teal-600 uppercase tracking-wider mt-6 mb-3 pb-2 border-b border-teal-100">
                    Wilayah</p>
                <div class="grid grid-cols-2 gap-4 mb-2">

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kecamatan</label>
                        <select name="id_kecamatan" onchange="filterKelurahan(this.value)"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
                            <option value="">Pilih Kecamatan</option>
                            @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}" {{ old('id_kecamatan')==$kecamatan->id ? 'selected' : ''
                                }}>
                                {{ $kecamatan->nama_kecamatan }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kecamatan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kelurahan / Nagari</label>
                        <select name="id_kelurahan" id="id_kelurahan"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
                            <option value="">Pilih Kelurahan</option>
                            @foreach ($kelurahans as $kelurahan)
                            <option value="{{ $kelurahan->id }}" data-kecamatan="{{ $kelurahan->id_kecamatan }}" {{
                                old('id_kelurahan')==$kelurahan->id ? 'selected' : '' }}>
                                {{ $kelurahan->nama_kelurahan }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kelurahan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>

                <p
                    class="text-xs font-medium text-teal-600 uppercase tracking-wider mt-6 mb-3 pb-2 border-b border-teal-100">
                    Lokasi GPS</p>
                <div class="grid grid-cols-2 gap-4 mb-2">

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Latitude</label>
                        <input type="text" id="latitude" name="latitude" readonly
                            class="w-full px-3 py-2 text-sm border border-dashed border-teal-300 rounded-lg bg-teal-50 text-gray-400 cursor-not-allowed"
                            placeholder="Menunggu GPS...">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Longitude</label>
                        <input type="text" id="longitude" name="longitude" readonly
                            class="w-full px-3 py-2 text-sm border border-dashed border-teal-300 rounded-lg bg-teal-50 text-gray-400 cursor-not-allowed"
                            placeholder="Menunggu GPS...">
                    </div>

                    <div class="col-span-2 flex items-center gap-3 flex-wrap">
                        <button type="button" onclick="getGPS()"
                            class="flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            Ambil Lokasi
                        </button>
                        <button type="button" id="btnWatch" onclick="toggleWatch()"
                            class="flex items-center gap-2 px-4 py-2 bg-white hover:bg-gray-50 text-teal-700 border border-teal-300 text-sm font-medium rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Pantau Otomatis
                        </button>
                        <span id="gpsStatus" class="text-xs text-gray-400 hidden"></span>
                    </div>

                </div>

                <hr class="border-gray-100 my-5">

                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Simpan Kontainer
                </button>

            </form>
        </div>
    </div>

    <script>
        let watchId = null;

        function setStatus(msg, color) {
            const el = document.getElementById('gpsStatus');
            el.textContent = msg;
            el.className = 'text-xs ' + (color || 'text-gray-400');
            el.classList.remove('hidden');
        }

        function getGPS() {
            if (!navigator.geolocation) return setStatus('GPS tidak didukung browser ini.', 'text-red-500');
            setStatus('Mengambil lokasi...', 'text-teal-600');
            navigator.geolocation.getCurrentPosition(
                function (pos) {
                    document.getElementById('latitude').value = pos.coords.latitude.toFixed(7);
                    document.getElementById('longitude').value = pos.coords.longitude.toFixed(7);
                    setStatus('✓ Lokasi didapatkan (akurasi: ' + Math.round(pos.coords.accuracy) + ' m)', 'text-teal-700');
                },
                function (err) {
                    setStatus('Gagal: ' + (err.code === 1 ? 'Izin ditolak' : 'Lokasi tidak tersedia'), 'text-red-500');
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        }

        function toggleWatch() {
            const btn = document.getElementById('btnWatch');
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
                watchId = null;
                btn.querySelector('span') && (btn.lastChild.textContent = ' Pantau Otomatis');
                setStatus('Pemantauan dihentikan.', 'text-gray-400');
            } else {
                setStatus('Memantau lokasi realtime...', 'text-teal-600');
                watchId = navigator.geolocation.watchPosition(
                    function (pos) {
                        document.getElementById('latitude').value = pos.coords.latitude.toFixed(7);
                        document.getElementById('longitude').value = pos.coords.longitude.toFixed(7);
                        setStatus('✓ Diperbarui ' + new Date().toLocaleTimeString('id-ID'), 'text-teal-700');
                    },
                    function () { setStatus('Gagal memantau lokasi.', 'text-red-500'); },
                    { enableHighAccuracy: true }
                );
            }
        }

        function filterKelurahan(kecamatanId) {
            document.querySelectorAll('#id_kelurahan option[data-kecamatan]').forEach(function (opt) {
                opt.style.display = !kecamatanId || opt.dataset.kecamatan == kecamatanId ? '' : 'none';
            });
            document.getElementById('id_kelurahan').value = '';
        }

        document.getElementById('formKontainer').addEventListener('submit', function (e) {
            if (!document.getElementById('latitude').value) {
                e.preventDefault();
                setStatus('❌ Ambil lokasi GPS terlebih dahulu.', 'text-red-500');
            }
        });
    </script> --}}

@extends('admin.app')

@section('title', 'Edit Kontainer Sampah')

@section('content')
    <div class="min-h-screen bg-gray-50 p-7">

        <div class="mb-6">
            <h1 class="text-lg font-medium text-gray-800">Edit Kontainer Sampah</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui data kontainer <span class="font-semibold text-teal-600">{{ $container->kode_containers }}</span></p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-6 max-w-2xl">
            <form action="{{ route('admin.kontainer.update', $container->id_container) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Identitas --}}
                <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mb-3 pb-2 border-b border-teal-100">Identitas Kontainer</p>
                <div class="grid grid-cols-2 gap-4 mb-4">

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kode Kontainer</label>
                        <input type="text" name="kode_containers"
                            value="{{ old('kode_containers', $container->kode_containers) }}"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: KNT-001">
                        @error('kode_containers') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kapasitas (liter)</label>
                        <input type="number" name="kapasitas"
                            value="{{ old('kapasitas', $container->kapasitas) }}" min="1"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
                            placeholder="Contoh: 500">
                        @error('kapasitas') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Nama Lokasi</label>
                        <input type="text" name="nama_lokasi"
                            value="{{ old('nama_lokasi', $container->nama_lokasi) }}"
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
                                    {{ old('id_kecamatan', $container->id_kecamatan) == $kecamatan->id_kecamatan ? 'selected' : '' }}>
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
                                    {{ old('id_kelurahan', $container->id_kelurahan) == $kelurahan->id_kelurahan ? 'selected' : '' }}>
                                    {{ $kelurahan->nama_kelurahan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kelurahan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>

                <hr class="border-gray-100 my-5">

                <div class="flex gap-3">
                    <a href="{{ route('admin.kontainer.index') }}"
                        class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-gray-50 text-gray-600 border border-gray-200 text-sm font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white text-sm font-medium rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Update Kontainer
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function filterKelurahan(kecamatanId) {
            const select = document.getElementById('id_kelurahan');
            const current = select.value;
            select.querySelectorAll('option[data-kecamatan]').forEach(function(opt) {
                opt.style.display = !kecamatanId || opt.dataset.kecamatan == kecamatanId ? '' : 'none';
            });
            // Reset hanya jika kecamatan berubah
            if (!kecamatanId || select.querySelector('option[value="' + current + '"]:not([style*="none"])') === null) {
                select.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanVal = document.getElementById('id_kecamatan').value;
            if (kecamatanVal) filterKelurahan(kecamatanVal);
        });
    </script>
@endsection
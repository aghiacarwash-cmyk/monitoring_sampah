@extends('admin.app')

@section('title', 'Tambah Kelurahan')

@section('content')
<div class="min-h-screen bg-gray-50 p-7">

  <div class="mb-6">
    <h1 class="text-lg font-medium text-gray-800">Tambah Kelurahan</h1>
    <p class="text-sm text-gray-500 mt-1">Tambahkan data kelurahan baru ke dalam sistem</p>
  </div>

  <div class="bg-white border border-gray-200 rounded-xl p-6 max-w-2xl">
    <!-- PASTIKAN ROUTE KE KELURAHAN STORE -->
    <form action="{{ route('admin.kelurahan.store') }}" method="POST">
      @csrf

      <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mb-3 pb-2 border-b border-teal-100">
        Identitas Kelurahan
      </p>

      <!-- Dropdown Pilihan Kecamatan Induk -->
      <div class="mb-4">
        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Kecamatan</label>
        <div class="relative">
          <select name="id_kecamatan" 
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition appearance-none">
            <option value="" disabled selected>-- Pilih Kecamatan --</option>
            @foreach($kecamatans as $k)
              <option value="{{ $k->id_kecamatan }}" {{ old('id_kecamatan') == $k->id_kecamatan ? 'selected' : '' }}>
                {{ $k->nama_kecamatan }}
              </option>
            @endforeach
          </select>
          <!-- Variasi icon panah bawah custom karena ada 'appearance-none' -->
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </div>
        @error('id_kecamatan')
          <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Input Nama Kelurahan -->
      <div class="mb-4">
        <label class="text-sm font-medium text-gray-500 mb-1.5 block">Nama Kelurahan</label>
        <input type="text" name="nama_kelurahan" value="{{ old('nama_kelurahan') }}"
          class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
          placeholder="Contoh: Kel. Flamboyan Baru">
        @error('nama_kelurahan')
          <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <hr class="border-gray-100 my-5">

      <!-- Tombol Aksi -->
      <div class="flex gap-3">
        <a href="{{ route('admin.kelurahan.index') }}"
          class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium rounded-lg transition">
          Batal
        </a>
        <button type="submit"
          class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white text-sm font-medium rounded-lg transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
          </svg>
          Simpan Kelurahan
        </button>
      </div>

    </form>
  </div>

</div>
@endsection
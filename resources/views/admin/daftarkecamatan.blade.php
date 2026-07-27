@extends('admin.app')

@section('title', 'Daftar Kecamatan')

@section('content')
<div class="min-h-screen bg-gray-50 p-7">

  {{-- Header --}}
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-lg font-medium text-gray-800">Daftar Kecamatan</h1>
      <p class="text-sm text-gray-500 mt-0.5">Total {{ $kecamatans->count() }} kecamatan terdaftar</p>
    </div>
    <a href="{{ route('admin.kecamatan.create') }}"
      class="flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white text-sm font-medium rounded-lg transition">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
      </svg>
      Tambah Kecamatan
    </a>
  </div>

  {{-- Flash message --}}
  @if (session('success'))
    <div class="mb-4 px-4 py-3 bg-teal-50 border border-teal-200 text-teal-700 text-sm rounded-lg">
      {{ session('success') }}
    </div>
  @endif

  {{-- Tabel --}}
  <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left">
        <thead>
          <tr class="bg-gray-50 border-b border-gray-200 text-xs font-medium text-gray-500 uppercase tracking-wider">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama Kecamatan</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse ($kecamatans as $index => $kec)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-4 py-3 text-gray-400">{{ $index + 1 }}</td>
              <td class="px-4 py-3 font-medium text-gray-800">{{ $kec->nama_kecamatan }}</td>
              <td class="px-4 py-3">
                <div class="flex items-center justify-center gap-2">

                  {{-- Edit --}}
                  <a href="{{ route('admin.kecamatan.edit', $kec->id_kecamatan) }}"
                    class="p-1.5 rounded-lg text-gray-400 hover:text-teal-600 hover:bg-teal-50 transition"
                    title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/>
                    </svg>
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('admin.kecamatan.destroy', $kec->id_kecamatan) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kecamatan {{ $kec->nama_kecamatan }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition"
                      title="Hapus">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                      </svg>
                    </button>
                  </form>

                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-4 py-12 text-center text-gray-400 text-sm">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/>
                </svg>
                Belum ada kecamatan terdaftar
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
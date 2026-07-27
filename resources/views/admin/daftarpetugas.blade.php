@extends('admin.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-7">

  {{-- Header --}}
 <div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-base md:text-lg font-medium text-gray-800">Daftar Petugas</h1>
    <p class="text-xs md:text-sm text-gray-500 mt-1">Kelola semua petugas yang terdaftar</p>
  </div>
  <div class="flex items-center gap-2">
    {{-- Tombol Export Excel --}}
    <a href="{{ route('admin.petugas.export') }}"
      class="flex items-center gap-2 px-3 md:px-4 py-2 bg-white hover:bg-gray-50 text-gray-600 text-xs md:text-sm font-medium rounded-lg border border-gray-200 transition whitespace-nowrap">
      <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
      <span class="hidden sm:inline">Export Excel</span>
      <span class="sm:hidden">Export</span>
    </a>
    {{-- Tombol Tambah Petugas --}}
    <a href="{{ route('admin.petugas.create') }}"
      class="flex items-center gap-2 px-3 md:px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-xs md:text-sm font-medium rounded-lg transition whitespace-nowrap">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.75 3.75 0 0 1 7.5 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/></svg>
      <span class="hidden sm:inline">Tambah Petugas</span>
      <span class="sm:hidden">Tambah</span>
    </a>
  </div>
</div>

  {{-- Success Message --}}
  @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-teal-50 border border-teal-200 text-teal-700 text-sm rounded-lg">
      {{ session('success') }}
    </div>
  @endif

  {{-- Table Card --}}
  <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

    {{-- Search & Total --}}
    <div class="flex items-center justify-between px-4 md:px-5 py-3 border-b border-gray-100 gap-3">
      <div class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 rounded-lg bg-gray-50 flex-1 max-w-xs">
        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
        <input type="text" placeholder="Cari petugas..." class="bg-transparent text-sm outline-none w-full text-gray-700 placeholder-gray-400">
      </div>
      <p class="text-xs md:text-sm text-gray-500 whitespace-nowrap">
        Total: <span class="font-medium text-teal-600">{{ $petugas->count() }}</span>
      </p>
    </div>

    {{-- Scrollable Table Wrapper --}}
    <div class="overflow-x-auto">
      <table class="w-full min-w-[600px]">
        <thead class="bg-teal-50 text-xs text-gray-500 uppercase tracking-wider">
          <tr>
            <th class="px-4 md:px-5 py-3 text-left font-medium">No</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Petugas</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Email</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Username</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Password</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">No HP</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Wilayah</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Status</th>
            <th class="px-4 md:px-5 py-3 text-left font-medium">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          @forelse($petugas as $index => $p)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 md:px-5 py-3 text-sm text-gray-400">{{ $index + 1 }}</td>
            <td class="px-4 md:px-5 py-3">
              <div class="flex items-center gap-2 md:gap-3">
                @if($p->foto)
                  <img src="{{ asset('storage/' . $p->foto) }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                @else
                  <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center text-xs font-medium text-teal-700 flex-shrink-0">
                    {{ strtoupper(substr($p->nama_lengkap, 0, 2)) }}
                  </div>
                @endif
                <div class="min-w-0">
                  <p class="text-sm font-medium text-gray-800 truncate max-w-[120px] md:max-w-none">{{ $p->nama_lengkap }}</p>
                  <p class="text-xs text-gray-400 truncate max-w-[120px] md:max-w-none">{{ $p->email }}</p>
                </div>
              </div>
            </td>
            <td class="px-4 md:px-5 py-3 text-sm text-gray-600 whitespace-nowrap">{{ $p->email ?? '-' }}</td>
            <td class="px-4 md:px-5 py-3 text-sm text-gray-600 whitespace-nowrap">{{ $p->username ?? '-' }}</td>
            <td class="px-4 md:px-5 py-3 text-sm text-gray-600 whitespace-nowrap">{{ $p->password ?? '-' }}</td>
            <td class="px-4 md:px-5 py-3 text-sm text-gray-600 whitespace-nowrap">{{ $p->no_hp ?? '-' }}</td>
            <td class="px-4 md:px-5 py-3 text-sm text-gray-600 whitespace-nowrap">{{ $p->wilayah_tugas ?? '-' }}</td>
            <td class="px-4 md:px-5 py-3">
              @if($p->status === 'aktif')
                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-teal-50 text-teal-700 whitespace-nowrap">Aktif</span>
              @else
                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 whitespace-nowrap">Nonaktif</span>
              @endif
            </td>
            <td class="px-4 md:px-5 py-3">
              <div class="flex items-center gap-1.5">
                {{-- Detail --}}
                {{-- <a href="#" class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-200 bg-gray-50 hover:bg-white transition">
                  <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                </a> --}}
                {{-- Edit --}}
                <a href="{{ route('admin.petugas.edit', $p->id_user) }}" class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-200 bg-gray-50 hover:bg-white transition">
                  <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                </a>
                {{-- Hapus --}}
                <form action="{{ route('petugas.destroy', $p->id_user) }}" method="POST" onsubmit="return confirm('Yakin hapus petugas ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="w-7 h-7 flex items-center justify-center rounded-md border border-red-200 bg-red-50 hover:bg-red-100 transition">
                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">
              Belum ada petugas terdaftar
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection
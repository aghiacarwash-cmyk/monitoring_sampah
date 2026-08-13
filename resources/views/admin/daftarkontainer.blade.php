@extends('admin.app')

@section('title', 'Daftar Kontainer Sampah')

@section('content')
<div class="min-h-screen bg-gray-50 p-7">

 <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-lg font-medium text-gray-800">Daftar Kontainer Sampah</h1>
      <p class="text-sm text-gray-500 mt-1">Total {{ $containers->count() }} kontainer terdaftar</p>
    </div>
    <div class="flex items-center gap-2">
      {{-- Export Excel --}}
      <a href="/export-excel"
        class="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
        Export Excel
      </a>
      {{-- Tambah Kontainer --}}
      <a href="{{ route('admin.kontainer.create') }}"
        class="flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        Tambah Kontainer
      </a>
    </div>
</div>

  {{-- Flash Message --}}
  @if (session('success'))
    <div class="mb-4 px-4 py-3 bg-teal-50 border border-teal-200 text-teal-700 text-sm rounded-lg">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
    <livewire:admin-daftarcontainer/>

    </div>
  </div>

</div>
@endsection
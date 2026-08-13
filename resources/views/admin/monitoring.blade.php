@extends('admin.app')

@section('title', 'Daftar Kontainer Sampah')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-lg font-medium text-gray-800">Data Riwayat Monitoring</h1>
    </div>

    <livewire:monitoring-log-list />
@endsection
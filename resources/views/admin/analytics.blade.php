@extends('admin.app')

@section('content')

    <div class="space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl font-bold text-on-surface">
                Analytics Dashboard
            </h1>

            <p class="text-on-surface-variant mt-1">
                Analisis kondisi seluruh kontainer sampah secara realtime.
            </p>
        </div>

        <!-- =========================
        CARD STATISTIK
        ========================== -->
                    <livewire:admin-analytic/>


@endsection
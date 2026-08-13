@extends('header')


@section('content')

    <!-- MAIN -->
    <main class="pt-24 px-8 pb-10">

        <!-- TITLE -->
        <div class="mb-8">

            <h1 class="text-4xl font-bold text-primary mb-2">
                Monitoring Tong Sampah IoT
            </h1>

            <p class="text-on-surface-variant">
                Monitoring real-time kapasitas tong sampah pintar
            </p>

        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">

            <!-- TOTAL -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Total Tong Sampah
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->count() }}
                </h4>

            </div>

            <!-- PENUH -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Penuh
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 81)->count() }}
                </h4>

            </div>

            <!-- BERISI -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Berisi
                </p>

                <h4 class="text-4xl font-bold text-yellow-700">
                    {{ $containers->whereBetween('persen', [11, 80])->count() }}
                </h4>

            </div>

            <!-- KOSONG -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Tong Kosong
                </p>

                <h4 class="text-4xl font-bold text-primary">
                    {{ $containers->where('persen', '<=', 10)->count() }}
                </h4>

            </div>

            <!-- BUTUH PENGOSONGAN -->
            <div class="bg-white border border-outline-variant p-5 rounded-xl shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Butuh Pengosongan
                </p>

                <h4 class="text-4xl font-bold text-red-600">
                    {{ $containers->where('persen', '>=', 90)->count() }}
                </h4>

            </div>

        </div>

        <!-- TABLE -->
            <livewire:info />


    </main>
@endsection

   
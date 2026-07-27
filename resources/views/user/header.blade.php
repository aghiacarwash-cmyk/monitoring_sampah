<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-tertiary-fixed-variant": "#6d390c",
                        "surface-container-low": "#f1f4f4",
                        "on-secondary-fixed-variant": "#00504b",
                        "tertiary-fixed": "#ffdcc5",
                        "tertiary-container": "#8e5426",
                        "on-primary": "#ffffff",
                        "secondary": "#236863",
                        "on-background": "#181c1d",
                        "on-primary-fixed": "#001f23",
                        "on-tertiary-fixed": "#301400",
                        "on-surface-variant": "#3e494a",
                        "surface-container-high": "#e6e9e9",
                        "inverse-primary": "#82d3de",
                        "surface-bright": "#f7fafa",
                        "surface-dim": "#d7dadb",
                        "on-surface": "#181c1d",
                        "surface-tint": "#006972",
                        "surface-container-highest": "#e0e3e3",
                        "secondary-fixed": "#acefe7",
                        "secondary-container": "#a9ece5",
                        "inverse-surface": "#2d3132",
                        "outline": "#6f797a",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#9becf7",
                        "secondary-fixed-dim": "#90d3cb",
                        "on-secondary-fixed": "#00201e",
                        "tertiary-fixed-dim": "#ffb783",
                        "primary-fixed-dim": "#82d3de",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#286d67",
                        "on-tertiary-container": "#ffd7bd",
                        "background": "#f7fafa",
                        "error": "#ba1a1a",
                        "primary": "#00535b",
                        "error-container": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "primary-container": "#006d77",
                        "surface": "#f7fafa",
                        "inverse-on-surface": "#eef1f2",
                        "on-primary-fixed-variant": "#004f56",
                        "surface-container": "#ebeeef",
                        "surface-variant": "#e0e3e3",
                        "outline-variant": "#bec8ca",
                        "primary-fixed": "#9ff0fb",
                        "tertiary": "#713d10",
                        "on-error": "#ffffff"
                    },
                    spacing: {
                        "card-padding": "20px",
                        "gutter": "24px",
                        "margin-page": "32px",
                        "stack-sm": "8px",
                        "stack-lg": "24px",
                        "stack-md": "16px",
                        "unit": "4px"
                    },
                    fontSize: {
                        "h1": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "label-caps": ["12px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600" }],
                        "h3": ["20px", { lineHeight: "28px", fontWeight: "600" }],
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "stat-value": ["36px", { lineHeight: "44px", letterSpacing: "-0.03em", fontWeight: "700" }],
                        "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "h2": ["24px", { lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "600" }]
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { background-color: #F8FAFA; }
    </style>
</head>

<body class="text-on-background" style="font-family: Inter, sans-serif; font-size: 14px;">

    <!-- HEADER -->
    <header class="bg-surface flex justify-between items-center px-4 md:px-8 w-full h-16 border-b border-outline-variant sticky top-0 z-50"
        style="backdrop-filter: blur(4px);"
        x-data="{ menuOpen: false }">

        <!-- LEFT -->
        <div class="flex items-center gap-4">
            <span class="text-xl font-bold text-primary">Clean IoT</span>
            <nav class="hidden md:flex gap-6 h-full items-center">
                <a class="text-on-surface-variant text-sm hover:text-primary transition-colors h-full flex items-center"
                    href="/petugas/dashboard">Dashboard</a>
                <a class="text-on-surface-variant text-sm hover:text-primary transition-colors h-full flex items-center"
                    href="/petugas/container">Info</a>
                <a class="text-on-surface-variant text-sm hover:text-primary transition-colors h-full flex items-center"
                    href="/petugas/monitoring-log">History</a>
            </nav>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-1 md:gap-3">

            @php
                use App\Models\Container;
                $warningPenuh   = Container::with(['kecamatan','kelurahan'])->where('persen', '>=', 80)->get();
                $warningBaterai = Container::with(['kecamatan','kelurahan'])->where('baterai', '<=', 20)->get();
                $totalNotif     = $warningPenuh->count() + $warningBaterai->count();
            @endphp

            <!-- NOTIFICATION -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="relative p-2 rounded-full hover:bg-surface-container-highest transition-colors active:scale-95">
                    <span class="material-symbols-outlined">notifications</span>
                    @if($totalNotif > 0)
                        <span class="absolute top-1 right-1 min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">
                            {{ $totalNotif }}
                        </span>
                    @endif
                </button>

                <!-- Dropdown — full width di mobile -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="fixed md:absolute left-2 right-2 md:left-auto md:right-0 top-[68px] md:top-auto md:mt-3 md:w-[400px] bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden z-50">

                    <div class="px-4 py-3 border-b bg-gray-50 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-700 text-sm">Notifikasi Kontainer</h3>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-400">{{ $totalNotif }} peringatan</span>
                            <button @click="open = false" class="p-1 rounded-full hover:bg-gray-200 md:hidden">
                                <span class="material-symbols-outlined text-gray-500" style="font-size:18px">close</span>
                            </button>
                        </div>
                    </div>

                    <div class="max-h-[60vh] md:max-h-[450px] overflow-y-auto divide-y divide-gray-100">
                        <div class="p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="material-symbols-outlined text-red-500 text-base">delete</span>
                                <h4 class="font-semibold text-red-600 text-sm">Kepenuhan ≥ 80%</h4>
                                <span class="ml-auto text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full">{{ $warningPenuh->count() }}</span>
                            </div>
                            @forelse($warningPenuh as $item)
                                <div class="mb-2 p-3 rounded-xl bg-red-50 border border-red-100">
                                    <div class="flex justify-between items-start gap-2">
                                        <div class="min-w-0">
                                            <div class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</div>
                                            <div class="text-xs text-gray-600 truncate">{{ $item->nama_lokasi }}</div>
                                            @if($item->kecamatan)
                                                <div class="text-xs text-gray-400">{{ $item->kecamatan->nama_kecamatan }}</div>
                                            @endif
                                        </div>
                                        <div class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold flex-shrink-0">{{ $item->persen }}%</div>
                                    </div>
                                    <div class="mt-2 h-1.5 bg-red-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-red-500 rounded-full" style="width: {{ $item->persen }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-xs text-gray-400 bg-gray-50 p-3 rounded-xl text-center">Tidak ada kontainer penuh</div>
                            @endforelse
                        </div>

                        <div class="p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="material-symbols-outlined text-yellow-500 text-base">battery_alert</span>
                                <h4 class="font-semibold text-yellow-600 text-sm">Baterai ≤ 20%</h4>
                                <span class="ml-auto text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">{{ $warningBaterai->count() }}</span>
                            </div>
                            @forelse($warningBaterai as $item)
                                <div class="mb-2 p-3 rounded-xl bg-yellow-50 border border-yellow-100">
                                    <div class="flex justify-between items-start gap-2">
                                        <div class="min-w-0">
                                            <div class="font-semibold text-gray-800 text-sm">{{ $item->kode_containers }}</div>
                                            <div class="text-xs text-gray-600 truncate">{{ $item->nama_lokasi }}</div>
                                            @if($item->kecamatan)
                                                <div class="text-xs text-gray-400">{{ $item->kecamatan->nama_kecamatan }}</div>
                                            @endif
                                        </div>
                                        <div class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold flex-shrink-0">{{ $item->baterai }}%</div>
                                    </div>
                                    <div class="mt-2 h-1.5 bg-yellow-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $item->baterai }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-xs text-gray-400 bg-gray-50 p-3 rounded-xl text-center">Tidak ada baterai lemah</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="px-4 py-3 border-t bg-gray-50 text-center">
                        <a href="/petugas/monitoring-log" class="text-xs text-teal-600 hover:underline font-medium">Lihat semua history →</a>
                    </div>
                </div>
            </div>

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 rounded-full hover:bg-error-container transition-colors active:scale-95">
                    <span class="material-symbols-outlined text-error">logout</span>
                </button>
            </form>

            <!-- PROFILE -->
            <div class="hidden md:flex items-center gap-2">
                <div class="h-9 w-9 rounded-full overflow-hidden border border-outline-variant bg-gray-100">
                    <img src="{{ session('foto') ? asset('storage/' . session('foto')) : asset('foto_petugas/default-user.png') }}"
                        alt="Foto" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-800 leading-none">{{ session('nama_lengkap') }}</div>
                    <div class="text-xs text-gray-500 mt-0.5">Petugas Kebersihan</div>
                </div>
            </div>

            <!-- HAMBURGER -->
            <button @click="menuOpen = !menuOpen" class="md:hidden p-2 rounded-full hover:bg-surface-container-highest transition">
                <span class="material-symbols-outlined" x-text="menuOpen ? 'close' : 'menu'">menu</span>
            </button>
        </div>

        <!-- NAV MOBILE -->
        <div x-show="menuOpen" x-transition
            class="md:hidden absolute top-16 left-0 right-0 bg-surface border-b border-outline-variant shadow-lg z-40 px-4 py-3 flex flex-col gap-1">

            <!-- Info user -->
            <div class="flex items-center gap-3 px-3 py-2 mb-1">
                <div class="h-9 w-9 rounded-full overflow-hidden border border-outline-variant bg-gray-100">
                    <img src="{{ session('foto') ? asset('storage/' . session('foto')) : asset('foto_petugas/default-user.png') }}"
                        alt="Foto" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-800">{{ session('nama_lengkap') }}</div>
                    <div class="text-xs text-gray-500">Petugas Kebersihan</div>
                </div>
            </div>

            <hr class="border-outline-variant mb-1">

            <a href="/petugas/dashboard"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->is('petugas/dashboard') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                <span class="material-symbols-outlined text-base">dashboard</span> Dashboard
            </a>
            <a href="/petugas/container"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->is('petugas/container') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                <span class="material-symbols-outlined text-base">info</span> Info Kontainer
            </a>
            <a href="/petugas/monitoring-log"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->is('petugas/monitoring-log*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                <span class="material-symbols-outlined text-base">history</span> History
            </a>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="w-full">
        @yield('content')
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-app.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging.js";
        const firebaseConfig = {
            apiKey: "AIzaSyCYl3EDyuMJmnVtW8vO4GYL_0l0-Gcp6JQ",
            authDomain: "clean-iot-monitoring.firebaseapp.com",
            projectId: "clean-iot-monitoring",
            storageBucket: "clean-iot-monitoring.firebasestorage.app",
            messagingSenderId: "733183787328",
            appId: "1:733183787328:web:3b18917e105f22b5007aa5"
        };
        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);
        Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                navigator.serviceWorker.register('/firebase-messaging-sw.js').then((registration) => {
                    getToken(messaging, {
                        vapidKey: "BNaAmUOo69gtnMTgoYge2WJxBHinqbEih6yy5NVuZcYUrJCY_bJhpi-SEqV3fj-kd6Ce7YTi8a3eK6yZ2-t66aE",
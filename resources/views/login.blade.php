<!DOCTYPE html>

<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#ffb783",
                        "primary-container": "#006d77",
                        "background": "#f7fafa",
                        "on-primary-fixed": "#001f23",
                        "secondary": "#236863",
                        "on-surface": "#181c1d",
                        "on-primary-container": "#9becf7",
                        "inverse-surface": "#2d3132",
                        "on-tertiary-container": "#ffd7bd",
                        "on-surface-variant": "#3e494a",
                        "surface-variant": "#e0e3e3",
                        "primary-fixed-dim": "#82d3de",
                        "secondary-fixed-dim": "#90d3cb",
                        "surface-container-high": "#e6e9e9",
                        "on-primary": "#ffffff",
                        "outline": "#6f797a",
                        "on-secondary-container": "#286d67",
                        "surface-container-highest": "#e0e3e3",
                        "on-tertiary-fixed-variant": "#6d390c",
                        "primary": "#00535b",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-container": "#8e5426",
                        "on-tertiary-fixed": "#301400",
                        "on-background": "#181c1d",
                        "on-secondary-fixed-variant": "#00504b",
                        "secondary-container": "#a9ece5",
                        "on-primary-fixed-variant": "#004f56",
                        "surface": "#f7fafa",
                        "error": "#ba1a1a",
                        "tertiary-fixed": "#ffdcc5",
                        "tertiary": "#713d10",
                        "on-secondary-fixed": "#00201e",
                        "surface-container": "#ebeeef",
                        "outline-variant": "#bec8ca",
                        "surface-bright": "#f7fafa",
                        "inverse-primary": "#82d3de",
                        "inverse-on-surface": "#eef1f2",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#9ff0fb",
                        "on-tertiary": "#ffffff",
                        "secondary-fixed": "#acefe7",
                        "on-error": "#ffffff",
                        "surface-container-low": "#f1f4f4",
                        "surface-tint": "#006972",
                        "surface-dim": "#d7dadb",
                        "on-error-container": "#93000a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "stack-lg": "24px",
                        "stack-sm": "8px",
                        "card-padding": "20px",
                        "unit": "4px",
                        "stack-md": "16px",
                        "margin-page": "32px"
                    },
                    "fontFamily": {
                        "h3": ["Inter"],
                        "stat-value": ["Inter"],
                        "label-caps": ["Inter"],
                        "h2": ["Inter"],
                        "body-lg": ["Inter"],
                        "h1": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "h3": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "stat-value": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.03em", "fontWeight": "700" }],
                        "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "h2": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "h1": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background text-on-background min-h-screen flex flex-col">
    <!-- TopAppBar (Logo only for Desktop) -->
    <header class="hidden lg:flex justify-start items-center w-full px-margin-page h-20 bg-surface">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-h2" data-icon="sensors">sensors</span>
            <h1 class="font-h2 text-h2 font-bold text-primary">Clean IoT</h1>
        </div>
    </header>
    <!-- Main Content Container -->
    <main class="flex-1 flex items-center justify-center p-6 md:p-12">
        <div
            class="max-w-6xl w-full bg-surface-container-lowest rounded-2xl shadow-xl overflow-hidden flex flex-col lg:flex-row min-h-[600px]">
            <!-- Visual Section (Split Screen Layout) -->
            <section
                class="lg:flex-1 bg-surface-container-low p-8 lg:p-12 flex flex-col justify-center items-center text-center">
                <!-- Logo for mobile (hidden on lg desktop header) -->
                <div class="lg:hidden flex items-center gap-2 mb-8">
                    <span class="material-symbols-outlined text-primary text-h2" data-icon="sensors">sensors</span>
                    <h1 class="font-h2 text-h2 font-bold text-primary">Clean IoT</h1>
                </div>
                <div class="w-full max-w-md aspect-square lg:aspect-auto lg:h-[400px] mb-8 overflow-hidden rounded-xl">
                    <img class="w-full h-full object-cover"
                        data-alt="A clean and professional digital illustration of a smart city waste management system under soft morning light. The artwork features minimalist 3D isometric icons of sensor-enabled trash bins and recycling centers connected by glowing teal data lines. The background is a soft off-white, reflecting a modern corporate aesthetic with a palette dominated by deep teal and soft mint accents to evoke a sense of environmental efficiency and high-tech reliability."
                        src="{{ asset('greencity.png') }}" />
                </div>
                <div class="max-w-sm hidden lg:block">
                    <h3 class="font-h3 text-h3 text-on-surface mb-2">Monitoring kontainer sampah pintar</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Sistem pemantauan sampah cerdas
                        berbasis IoT untuk kota yang lebih bersih dan berkelanjutan.</p>
                </div>
            </section>
            <!-- Form Section -->
            <section class="lg:w-[480px] p-8 lg:p-16 flex flex-col justify-center">
                <!-- Tombol Kembali -->
                <a href="/"
                    class="inline-flex items-center gap-1 text-on-surface-variant hover:text-primary transition-colors mb-6 font-body-md text-body-md w-fit">
                    <span class="material-symbols-outlined text-body-lg" data-icon="arrow_back">arrow_back</span>
                    Kembali
                </a>
                <div class="mb-10">
                    <h2 class="font-h1 text-h1 text-on-surface mb-2">Selamat Datang</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Masuk ke akun Anda sebagai petugas.</p>
                </div>
                @if(session('error'))

                    <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">

                        {{ session('error') }}

                    </div>

                @endif
                <form action="/login" method="POST" class="space-y-stack-md">
                    <!-- Email Input -->
                    @csrf
                    <div class="space-y-stack-sm">
                        <label class="font-label-caps text-label-caps text-on-surface-variant uppercase"
                            for="email">Email</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                                name="email" placeholder="nama@email.com" type="email" />
                        </div>
                    </div>
                    <!-- Password Input -->
                    <div class="space-y-stack-sm">
                        <label class="font-label-caps text-label-caps text-on-surface-variant uppercase"
                            for="password">Kata Sandi</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                                name="password" placeholder="Masukkan kata sandi" type="password" />
                            <button
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors"
                                type="button">
                                <span class="material-symbols-outlined text-body-lg"
                                    data-icon="visibility">visibility</span>
                            </button>
                        </div>
                    </div>
                    <!-- Forgot Password -->
                    {{-- <div class="flex justify-end">
                        <a class="font-body-md text-body-md text-secondary hover:underline transition-all" href="#">Lupa
                            Kata Sandi?</a>
                    </div> --}}
                    <!-- Login Button -->
                    <div class="pt-stack-md">
                        <button
                            class="w-full bg-primary-container text-on-primary font-body-lg py-4 rounded-lg font-semibold active:scale-95 transition-transform shadow-md hover:opacity-90"
                            type="submit">
                            Masuk
                        </button>
                    </div>
                    <!-- Sign Up Link -->
                    <div class="text-center pt-stack-lg">
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Belum punya akun?
                            Hubungi Admin
                        </p>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <!-- Footer for Desktop -->
    <footer class="hidden lg:block py-6 text-center text-on-surface-variant font-body-md">
        <p>© 2026 Clean IoT. Semua Hak Dilindungi.</p>
    </footer>
</body>

</html>
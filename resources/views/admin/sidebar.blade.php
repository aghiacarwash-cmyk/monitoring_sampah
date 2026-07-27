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
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-fixed": "#acefe7",
                        "on-tertiary": "#ffffff",
                        "surface-dim": "#d7dadb",
                        "outline-variant": "#bec8ca",
                        "on-secondary-fixed-variant": "#00504b",
                        "on-secondary-fixed": "#00201e",
                        "inverse-on-surface": "#eef1f2",
                        "background": "#f7fafa",
                        "secondary-container": "#a9ece5",
                        "tertiary-container": "#8e5426",
                        "on-secondary-container": "#286d67",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#9ff0fb",
                        "primary": "#00535b",
                        "surface-container-highest": "#e0e3e3",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed": "#301400",
                        "error": "#ba1a1a",
                        "surface": "#f7fafa",
                        "tertiary": "#713d10",
                        "surface-container-low": "#f1f4f4",
                        "primary-container": "#006d77",
                        "on-surface": "#181c1d",
                        "inverse-primary": "#82d3de",
                        "tertiary-fixed": "#ffdcc5",
                        "surface-tint": "#006972",
                        "secondary": "#236863",
                        "tertiary-fixed-dim": "#ffb783",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#ebeeef",
                        "primary-fixed-dim": "#82d3de",
                        "on-primary-container": "#9becf7",
                        "on-tertiary-fixed-variant": "#6d390c",
                        "inverse-surface": "#2d3132",
                        "surface-container-high": "#e6e9e9",
                        "outline": "#6f797a",
                        "on-error-container": "#93000a",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#001f23",
                        "on-primary-fixed-variant": "#004f56",
                        "on-background": "#181c1d",
                        "surface-bright": "#f7fafa",
                        "surface-variant": "#e0e3e3",
                        "on-surface-variant": "#3e494a",
                        "on-tertiary-container": "#ffd7bd",
                        "secondary-fixed-dim": "#90d3cb",
                        "on-secondary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "stack-sm": "8px",
                        "stack-md": "16px",
                        "gutter": "24px",
                        "card-padding": "20px",
                        "margin-page": "32px",
                        "unit": "4px",
                        "stack-lg": "24px"
                    },
                    "fontFamily": {
                        "h2": ["Inter"],
                        "h3": ["Inter"],
                        "body-md": ["Inter"],
                        "h1": ["Inter"],
                        "body-lg": ["Inter"],
                        "stat-value": ["Inter"],
                        "label-caps": ["Inter"]
                    },
                    "fontSize": {
                        "h2": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "h3": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "h1": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "stat-value": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.03em", "fontWeight": "700" }],
                        "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            background-color: #f7fafa;
        }
    </style>
</head>

<body class="font-body-md text-on-surface">
    <!-- SideNavBar -->
    <aside
        class="fixed left-0 top-0 h-full w-64 z-50 flex flex-col py-margin-page bg-surface-container-low border-r border-outline-variant">

        {{-- Brand --}}
        <div class="px-card-padding mb-stack-lg">
            <h1 class="font-h3 text-h3 font-bold text-primary">Clean IoT</h1>
            <p class="font-body-md text-on-surface-variant opacity-70">Industrial IoT Portal</p>
        </div>

        {{-- Navigation --}}
        <nav class="flex-grow flex flex-col gap-1">

            {{-- Dashboard --}}
            <a href="/admin/dashboard" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
                {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined
                {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'filled-icon' : '' }}"
                    style="{{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    dashboard
                </span>
                <span class="font-body-md">Dashboard</span>
            </a>

            {{-- Analytics --}}
            <a href="/admin/analytics" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
                {{ request()->is('admin/analytics') || request()->is('admin/analytics/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/analytics') || request()->is('admin/analytics/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    analytics
                </span>
                <span class="font-body-md">Analytics</span>
            </a>

            {{-- Tambah Petugas --}}
            <a href="/admin/tambah/petugas" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
                {{ request()->is('admin/tambah/petugas') || request()->is('admin/tambah/petugas/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/tambah/petugas') || request()->is('admin/tambah/petugas/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    person_add
                </span>
                <span class="font-body-md">Tambah Petugas</span>
            </a>

            {{-- Daftar Petugas --}}
            <a href="/admin/daftar/petugas" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
                {{ request()->is('admin/daftar/petugas') || request()->is('admin/daftar/petugas/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/daftar/petugas') || request()->is('admin/daftar/petugas/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    manage_accounts
                </span>
                <span class="font-body-md">Daftar Petugas</span>
            </a>

            {{-- Tambah Kontainer Sampah --}}
            <a href="/admin/tambah/kontainer" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
                {{ request()->is('admin/tambah/kontainer') || request()->is('admin/tambah/kontainer/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/tambah/kontainer') || request()->is('admin/tambah/kontainer/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    delete_sweep
                </span>
                <span class="font-body-md">Tambah Kontainer Sampah</span>
            </a>
            <a href="/admin/daftar/kontainer" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
                {{ request()->is('admin/daftar/kontainer') || request()->is('admin/daftar/kontainer/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/daftar/kontainer') || request()->is('admin/daftar/kontainer/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    delete_forever
                </span>
                <span class="font-body-md">Daftar Kontainer Sampah</span>
            </a>
            {{-- Kecamatan --}}
            <a href="/admin/kecamatan" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
    {{ request()->is('admin/kecamatan') || request()->is('admin/kecamatan/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/kecamatan') || request()->is('admin/kecamatan/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    location_city
                </span>
                <span class="font-body-md">Kecamatan</span>
            </a>

            {{-- Kelurahan --}}
            <a href="/admin/kelurahan" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
    {{ request()->is('admin/kelurahan') || request()->is('admin/kelurahan/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/kelurahan') || request()->is('admin/kelurahan/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    holiday_village
                </span>
                <span class="font-body-md">Kelurahan</span>
            </a>
            {{-- history --}}
            <a href="/admin/monitoring-log" class="flex items-center gap-stack-md px-card-padding py-stack-md rounded-lg mx-2 transition-all duration-200
    {{ request()->is('admin/monitoring-log') || request()->is('admin/monitoring-log/*')
    ? 'bg-secondary-container text-on-secondary-container font-semibold translate-x-1'
    : 'text-on-surface-variant hover:bg-surface-container-high hover:translate-x-1' }}">
                <span class="material-symbols-outlined"
                    style="{{ request()->is('admin/monitoring-log') || request()->is('admin/monitoring-log/*') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    history
                </span>
                <span class="font-body-md">History</span>
            </a>

        </nav>

        {{-- System Status --}}
        {{-- <div class="mt-auto px-card-padding">
            <div
                class="bg-secondary-fixed text-on-secondary-fixed-variant px-stack-md py-stack-sm rounded-lg flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span class="font-label-caps text-label-caps">System Status: Active</span>
            </div>
        </div> --}}

    </aside>
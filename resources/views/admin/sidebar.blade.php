<!-- SideNavBar -->
<aside
    class="fixed left-0 top-0 h-full w-64 z-50 flex flex-col py-margin-page bg-surface-container-low border-r border-outline-variant">

    {{-- Brand --}}
    <div class="px-card-padding mb-stack-lg shrink-0">
        <h1 class="font-h3 text-h3 font-bold text-primary">Clean IoT</h1>
        <p class="font-body-md text-on-surface-variant opacity-70">Industrial IoT Portal</p>
    </div>

    {{-- Navigation --}}
    <nav class="flex-grow flex flex-col gap-1 overflow-y-auto min-h-0 pr-1">

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
<!-- TopAppBar -->
<header
    class="flex justify-between items-center w-full px-margin-page h-16 bg-surface border-b border-outline-variant sticky top-0 z-40">

    <!-- LEFT -->
    <div class="flex items-center gap-stack-md">
        <h2 class="font-h2 text-h2 text-primary">Clean IoT</h2>
        <div class="relative ml-stack-lg">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">search</span>
            <input class="pl-10 pr-4 py-2 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary text-body-md w-64 transition-all"
                placeholder="Cari lokasi atau ID bin..." type="text" />
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

            <livewire:admin-notifikasi />


        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="p-2 rounded-full hover:bg-error-container transition-colors active:scale-95 duration-150">
                <span class="material-symbols-outlined text-error">logout</span>
            </button>
        </form>

        <!-- PROFILE -->
        <div class="flex items-center gap-3 ml-2">
            <div class="h-10 w-10 rounded-full overflow-hidden border border-outline-variant bg-gray-100">
                <img src="{{ session('foto') ? asset('storage/' . session('foto')) : asset('foto_petugas/default-user.png') }}"
                    alt="Foto" class="w-full h-full object-cover">
            </div>
            <div class="hidden md:block">
                <div class="text-sm font-semibold text-gray-800 leading-none">{{ session('nama_lengkap') }}</div>
                <div class="text-xs text-gray-500 mt-1">Petugas Kebersihan</div>
            </div>
        </div>

    </div>
</header>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
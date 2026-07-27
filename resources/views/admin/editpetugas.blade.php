@extends('admin.app')

@section('content')
<div class="min-h-screen bg-gray-50 p-7">

  <div class="mb-6">
    <h1 class="text-lg font-medium text-gray-800">Edit Petugas</h1>
    <p class="text-sm text-gray-500 mt-1">Ubah data petugas — kosongkan password jika tidak ingin menggantinya</p>
  </div>

  <div class="bg-white border border-gray-200 rounded-xl p-6 max-w-2xl">
    <form action="{{ route('admin.petugas.update', $user) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Akun & Keamanan --}}
      <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mb-3 pb-2 border-b border-teal-100">Akun & Keamanan</p>
      <div class="grid grid-cols-2 gap-4 mb-2">

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 1 0-8 0 4 4 0 0 0 8 0Zm0 0v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-9 9m4.5-1.206a8.959 8.959 0 0 1-4.5 1.207"/></svg>
            Username
          </label>
          <input type="text" name="username" value="{{ old('username', $user->username) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="username">
          @error('username') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
            Email
          </label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="contoh@email.com">
          @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
            Password
            <span class="text-xs text-gray-400 font-normal">(kosongkan jika tidak diganti)</span>
          </label>
          <input type="password" name="password"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="••••••••">
          @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z"/></svg>
            NIK
          </label>
          <input type="text" name="nik" value="{{ old('nik', $user->nik) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="16 digit NIK" maxlength="20">
          @error('nik') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

      </div>

      {{-- Data Pribadi --}}
      <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mt-6 mb-3 pb-2 border-b border-teal-100">Data Pribadi</p>
      <div class="grid grid-cols-2 gap-4 mb-2">

        <div class="col-span-2">
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/></svg>
            Nama Lengkap
          </label>
          <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="Nama lengkap sesuai KTP">
          @error('nama_lengkap') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/></svg>
            Jenis Kelamin
          </label>
          <select name="jenis_kelamin"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
            <option value="">Pilih jenis kelamin</option>
            <option value="Laki-laki"  {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan"  {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
          </select>
          @error('jenis_kelamin') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
            Tanggal Lahir
          </label>
          <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
          @error('tanggal_lahir') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
            No HP
          </label>
          <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="08xxxxxxxxxx" maxlength="15">
          @error('no_hp') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
            Wilayah Tugas
          </label>
          <input type="text" name="wilayah_tugas" value="{{ old('wilayah_tugas', $user->wilayah_tugas) }}"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition"
            placeholder="Contoh: Kec. Padang Barat">
          @error('wilayah_tugas') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="col-span-2">
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
            Alamat
          </label>
          <textarea name="alamat" rows="3"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition resize-none"
            placeholder="Alamat lengkap petugas">{{ old('alamat', $user->alamat) }}</textarea>
          @error('alamat') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

      </div>

      {{-- Pengaturan Akun --}}
      <p class="text-xs font-medium text-teal-600 uppercase tracking-wider mt-6 mb-3 pb-2 border-b border-teal-100">Pengaturan Akun</p>
      <div class="grid grid-cols-2 gap-4 mb-2">

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
            Role
          </label>
          <select name="role"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
            <option value="">Pilih role</option>
            <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
            <option value="admin"   {{ old('role', $user->role) == 'admin'   ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
            Status
          </label>
          <select name="status"
            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition">
            <option value="aktif"    {{ old('status', $user->status) == 'aktif'    ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
          </select>
          @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Foto --}}
        <div class="col-span-2">
          <label class="flex items-center gap-1.5 text-sm font-medium text-gray-500 mb-1.5">
            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            Foto
          </label>

          {{-- Preview foto saat ini --}}
          @if ($user->foto)
            <div class="flex items-center gap-3 mb-2 p-2 border border-gray-200 rounded-lg bg-gray-50">
              <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto saat ini"
                class="w-12 h-12 rounded-lg object-cover border border-gray-200">
              <div>
                <p class="text-xs text-gray-500">Foto saat ini</p>
                <p class="text-xs text-gray-400">Upload foto baru untuk menggantinya</p>
              </div>
            </div>
          @endif

          <label class="flex items-center gap-3 p-3 border border-dashed border-teal-300 rounded-lg bg-teal-50 cursor-pointer hover:bg-teal-100 transition">
            <div class="w-9 h-9 rounded-lg bg-teal-200 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-teal-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
            </div>
            <div>
              <p class="text-sm text-gray-600">Klik untuk upload foto baru</p>
              <p class="text-xs text-gray-400">JPG, PNG — maks. 2MB</p>
            </div>
            <input type="file" name="foto" class="hidden" accept="image/jpeg,image/png">
          </label>
          @error('foto') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

      </div>

      <hr class="border-gray-100 my-5">

      <div class="flex gap-3">
        <a href="{{ route('admin.petugas.index') }}"
          class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 text-gray-600 hover:bg-gray-50 text-sm font-medium rounded-lg transition">
          Batal
        </a>
        <button type="submit"
          class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white text-sm font-medium rounded-lg transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
          Simpan Perubahan
        </button>
      </div>

    </form>
  </div>
</div>
@endsection
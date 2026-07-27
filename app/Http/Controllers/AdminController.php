<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\User;

use Illuminate\Http\Request;
use App\Exports\PetugasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dashboard()
    {
        Container::where('updated_at', '<', now()->subMinutes(60))
    ->update([
        'status_system' => 'Offline'
    ]);
        $containers = Container::with([
            'kecamatan',
            'kelurahan'
        ])->get();

        // HITUNG TOTAL WARNING
        $totalWarning =
            $containers->where('persen', '>=', 80)->count()
            +
            $containers->where('baterai', '<=', 20)->count();

        return view('admin.dashboard', compact(
            'containers',
            'totalWarning'
        ));
    }
     public function analytics()
    {
        Container::where('updated_at', '<', now()->subMinutes(60))
        ->update([
            'status_system' => 'Offline'
        ]);
        $containers = Container::with([
            'kecamatan',
            'kelurahan'
        ])->get();

        return view('admin.analytics', compact('containers'));
    }
    public function createPetugas()
{
    return view('admin.tambahpetugas');
}

public function storePetugas(Request $request)
{
    $request->validate([
        'username'      => 'required|string|max:50|unique:users,username',
        'email'         => 'required|email|unique:users,email',
        'password'      => 'required|min:6',
        'nik'           => 'required|string|max:20|unique:users,nik',
        'nama_lengkap'  => 'required|string|max:100',
        'jenis_kelamin' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'no_hp'         => 'nullable|string|max:15',
        'wilayah_tugas' => 'nullable|string|max:100',
        'alamat'        => 'nullable|string',
        'role'          => 'required|string|max:20',
        'status'        => 'required|in:aktif,nonaktif',
    ]);

    $data = [
        'username'      => $request->username,
        'email'         => $request->email,
        'password'      => bcrypt($request->password),
        'nik'           => $request->nik,
        'nama_lengkap'  => $request->nama_lengkap,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'no_hp'         => $request->no_hp,
        'wilayah_tugas' => $request->wilayah_tugas,
        'alamat'        => $request->alamat,
        'role'          => $request->role,
        'status'        => $request->status,
    ];

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('foto_petugas', 'public');
    }

    \App\Models\User::create($data);

    return redirect()->route('admin.petugas.index')
        ->with('success', 'Petugas berhasil ditambahkan');
}
public function daftarPetugas()
{
    $petugas = \App\Models\User::all();
    return view('admin.daftarpetugas', compact('petugas'));
    // $petugas = \App\Models\User::where('role', 'petugas')->get();
    // return view('admin.daftarpetugas', compact('petugas'));
}
 public function exportPetugas()
{
    return Excel::download(
        new PetugasExport,
        'daftar_petugas_kebersihan.xlsx'
    );
}
  public function editPetugas(User $user)
    {
        return view('admin.editpetugas', compact('user'));
    }

   public function updatePetugas(Request $request, User $user)
{
    $request->validate([
        'username'      => 'required|string|max:50|unique:users,username,' . $user->id_user . ',id_user',
        'email'         => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
        'password'      => 'nullable|min:6',
        'nik'           => 'required|string|max:20|unique:users,nik,' . $user->id_user . ',id_user',
        'nama_lengkap'  => 'required|string|max:100',
        'jenis_kelamin' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'no_hp'         => 'nullable|string|max:15',
        'wilayah_tugas' => 'nullable|string|max:100',
        'alamat'        => 'nullable|string',
        'role'          => 'required|string|max:20',
        'status'        => 'required|in:aktif,nonaktif',
        'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'username', 'email', 'nik', 'nama_lengkap',
        'jenis_kelamin', 'tanggal_lahir', 'no_hp',
        'wilayah_tugas', 'alamat', 'role', 'status',
    ]);

    // Update password hanya jika diisi
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    // Ganti foto jika ada upload baru
    if ($request->hasFile('foto')) {
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }
        $data['foto'] = $request->file('foto')->store('foto_petugas', 'public');
    }

    $user->update($data);

    return redirect()->route('admin.petugas.index')
        ->with('success', 'Data petugas berhasil diperbarui.');
}

    public function destroyPetugas(User $user)
    {
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil dihapus.');
    }


}
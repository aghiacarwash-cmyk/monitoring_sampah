<?php
namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::withCount('kelurahans')->get();
        return view('admin.daftarkecamatan', compact('kecamatans'));
    }

    public function create()
    {
        return view('admin.tambahkecamatan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|unique:kecamatan,nama_kecamatan'
        ]);

        Kecamatan::create($request->only('nama_kecamatan'));

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    // ← INI YANG KURANG
    public function edit($id)
    {
        $kecamatan = Kecamatan::where('id_kecamatan', $id)->firstOrFail();
        return view('admin.editkecamatan', compact('kecamatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kecamatan' => 'required|unique:kecamatan,nama_kecamatan,' . $id . ',id_kecamatan'
        ]);

        Kecamatan::where('id_kecamatan', $id)->update($request->only('nama_kecamatan'));

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Kecamatan::where('id_kecamatan', $id)->delete();

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus!');
    }
}
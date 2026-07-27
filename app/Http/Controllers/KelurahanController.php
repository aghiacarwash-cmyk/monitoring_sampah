<?php
namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index()
    {
        $kelurahans = Kelurahan::with('kecamatan')->get();
        $kecamatans = Kecamatan::all();
        return view('admin.daftarkelurahan', compact('kelurahans', 'kecamatans'));
    }

    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.tambahkelurahan', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelurahan' => 'required|string|max:100',
            'id_kecamatan'   => 'required|exists:kecamatan,id_kecamatan',
        ]);

        Kelurahan::create($request->only('nama_kelurahan', 'id_kecamatan'));

        return redirect()->route('admin.kelurahan.index')
            ->with('success', 'Kelurahan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kelurahan  = Kelurahan::where('id_kelurahan', $id)->firstOrFail();
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.editkelurahan', compact('kelurahan', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelurahan' => 'required|string|max:100',
            'id_kecamatan'   => 'required|exists:kecamatan,id_kecamatan',
        ]);

        Kelurahan::where('id_kelurahan', $id)->update($request->only('nama_kelurahan', 'id_kecamatan'));

        return redirect()->route('admin.kelurahan.index')
            ->with('success', 'Kelurahan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Kelurahan::where('id_kelurahan', $id)->delete();

        return redirect()->route('admin.kelurahan.index')
            ->with('success', 'Kelurahan berhasil dihapus!');
    }
}
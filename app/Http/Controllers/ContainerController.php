<?php
namespace App\Http\Controllers;

use App\Exports\ContainersExport;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function dashboard()
    {
        Container::where('updated_at', '<', now()->subMinutes(60))
            ->update([
        'status_system' => 'Offline'
                    ]);
        $containers = Container::with(['kecamatan', 'kelurahan'])->get();
        $total  = Container::count();
        $penuh  = Container::where('status', 'Penuh')->count();
        $berisi = Container::where('status', 'Berisi')->count();
        $kosong = Container::where('status', 'Kosong')->count();

        return view('dashboard', compact('containers', 'total', 'penuh', 'berisi', 'kosong'));
    }

    public function info()
    {
        $containers = Container::all();
        $total  = Container::count();
        $penuh  = Container::where('status', 'Penuh')->count();
        $berisi = Container::where('status', 'Berisi')->count();
        $kosong = Container::where('status', 'Kosong')->count();

        return view('info', compact('containers', 'total', 'penuh', 'berisi', 'kosong'));
    }

    public function exportExcel()
    {
        return Excel::download(new ContainersExport, 'daftar_monitoring_container.xlsx');
    }

    public function index()
    {
        Container::where('updated_at', '<', now()->subMinutes(60))
    ->update([
        'status_system' => 'Offline'
    ]);
        $containers = Container::with(['kecamatan', 'kelurahan'])->get();
        return view('admin.daftarkontainer', compact('containers'));
    }

    public function create()
    {
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        return view('admin.tambahkontainer', compact('kecamatans', 'kelurahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_containers' => 'required|unique:containers,kode_containers',
            'nama_lokasi'     => 'required',
            'kapasitas'       => 'required|integer|min:1',
        ]);

        Container::create($request->all());
        return redirect()->route('admin.kontainer.index')->with('success', 'Kontainer berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $container  = Container::where('id_container', $id)->firstOrFail();
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        return view('admin.editkontainer', compact('container', 'kecamatans', 'kelurahans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_containers' => 'required|unique:containers,kode_containers,' . $id . ',id_container',
            'nama_lokasi'     => 'required',
            'kapasitas'       => 'required|integer|min:1',
        ]);

            Container::where('id_container', $id)->update($request->only([
            'kode_containers', 'nama_lokasi', 'kapasitas', 'id_kecamatan', 'id_kelurahan'
        ]));        return redirect()->route('admin.kontainer.index')->with('success', 'Kontainer berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Container::where('id_container', $id)->delete();
        return redirect()->route('admin.kontainer.index')->with('success', 'Kontainer berhasil dihapus!');
    }
}
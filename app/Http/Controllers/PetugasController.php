<?php

namespace App\Http\Controllers;

use App\Models\Container;

class PetugasController extends Controller
{
    // DASHBOARD PETUGAS
    public function dashboard()
    {
         if (!session('id_user')) {
            return redirect('/login');
        }
        Container::where('updated_at', '<', now()->subMinutes(60))
    ->update([
        'status_system' => 'Offline'
    ]);
        
        $containers = Container::all();

        $total = Container::count();

        $penuh = Container::where('persen', '>=', 81)->count();

        $berisi = Container::whereBetween('persen', [11, 80])->count();

        $kosong = Container::where('persen', '<=', 10)->count();

        return view('user.dashboard', compact(
            'containers',
            'total',
            'penuh',
            'berisi',
            'kosong'
        ));
    }

    // DATA CONTAINER
    public function container()
    {
        if (!session('id_user')) {
            return redirect('/login');
        }

        $containers = Container::all();

        return view('user.info', compact('containers'));
    }

    // NOTIFIKASI
    public function notifikasi()
    {
        if (!session('id_user')) {
            return redirect('/login');
        }

        return view('user.notifikasi');
    }

    // LAPORAN
    public function laporan()
    {
        if (!session('id_user')) {
            return redirect('/login');
        }

        return view('user.laporan');
    }
}
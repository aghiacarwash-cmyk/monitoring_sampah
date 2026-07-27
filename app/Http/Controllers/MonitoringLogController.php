<?php

namespace App\Http\Controllers;

use App\Models\MonitoringLog;

class MonitoringLogController extends Controller
{
    public function index()
    {
        $logs = MonitoringLog::with(['kecamatan','kelurahan'])
            ->orderBy('waktu', 'desc')
            ->paginate(20);

        if (session('role') == 'admin') {
            return view('admin.monitoring', compact('logs'));
        }

        if (session('role') == 'petugas') {
            return view('user.monitoring', compact('logs'));
        }

        abort(403);
    }
}
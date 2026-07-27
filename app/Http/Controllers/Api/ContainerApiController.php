<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\MonitoringLog;

class ContainerApiController extends Controller
{
    protected Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function update(Request $request)
    {
        $container = Container::where('kode_containers', $request->kode_containers)->first();

        if (!$container) {
            return response()->json([
                'message' => 'Kontainer tidak ditemukan'
            ], 404);
        }

        $container->update([
            'persen'        => $request->persen,
            'status'        => $request->status,
            'baterai'       => $request->baterai,
            'status_system' => 'Online',
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'updated_at'    => now(),
        
            ]);

            MonitoringLog::create([
                'waktu' => now(),
                'kode_container' => $container->kode_containers,
                'id_kecamatan'   => $container->id_kecamatan,
                'id_kelurahan'   => $container->id_kelurahan,
                'persen'         => $request->persen,
                'baterai'        => $request->baterai,
                'status'         => $request->status,
                'latitude'       => $request->latitude,
                'longitude'      => $request->longitude,
            ]);
        
        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI KONTAINER
        |--------------------------------------------------------------------------
        */

        $levelSebelumnya = $container->notif_level;
        $levelSekarang = null;

        if ($request->persen >= 100) {
            $levelSekarang = 'penuh';
        } elseif ($request->persen >= 80) {
            $levelSekarang = 'hampir_penuh';
        }

        // Reset jika sudah di bawah 80%
        if ($levelSekarang === null) {

            if ($levelSebelumnya !== null) {
                $container->update([
                    'notif_level' => null
                ]);
            }

        }
        // Pertama kali masuk hampir penuh
        elseif ($levelSekarang === 'hampir_penuh' && $levelSebelumnya === null) {

            $this->kirimNotif(
                '⚠️ Kontainer Hampir Penuh',
                "Kontainer {$request->kode_containers} telah mencapai {$request->persen}%"
            );

            $container->update([
                'notif_level' => 'hampir_penuh'
            ]);

        }
        // Pertama kali penuh
        elseif ($levelSekarang === 'penuh' && $levelSebelumnya !== 'penuh') {

            $this->kirimNotif(
                '🚨 Kontainer Penuh',
                "Kontainer {$request->kode_containers} sudah PENUH ({$request->persen}%). Segera dikosongkan!"
            );

            $container->update([
                'notif_level' => 'penuh'
            ]);

        }
        // Turun dari penuh menjadi hampir penuh
        elseif ($levelSekarang === 'hampir_penuh' && $levelSebelumnya === 'penuh') {

            $container->update([
                'notif_level' => 'hampir_penuh'
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI BATERAI
        |--------------------------------------------------------------------------
        */

        if ($request->baterai <= 20 && !$container->notif_baterai) {

            $this->kirimNotif(
                '🔋 Baterai Lemah',
                "Kontainer {$request->kode_containers} baterai tersisa {$request->baterai}%. Segera diisi ulang!"
            );

            $container->update([
                'notif_baterai' => true
            ]);

        } elseif ($request->baterai > 20 && $container->notif_baterai) {

            $container->update([
                'notif_baterai' => false
            ]);

        }

        return response()->json([
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    public function index()
    {
        return response()->json(
            Container::with(['kecamatan', 'kelurahan'])->get()
        );
    }

    private function kirimNotif($judul, $isi)
    {
        $tokens = User::whereNotNull('fcm_token')
            ->pluck('fcm_token')
            ->unique();

        foreach ($tokens as $token) {

            try {

                $message = CloudMessage::withTarget('token', $token)
                    ->withNotification(
                        Notification::create($judul, $isi)
                    );

                $this->messaging->send($message);

            } catch (\Exception $e) {

                Log::error($e->getMessage());

            }

        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class TestNotificationController extends Controller
{
    protected Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function kirim()
    {
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token');

        foreach ($tokens as $token) {

            $message = CloudMessage::withTarget('token', $token)
                ->withNotification(
                    Notification::create(
                        '🧪 TEST NOTIFIKASI',
                        'Jika notifikasi ini muncul berarti Firebase berhasil.'
                    )
                );

            $this->messaging->send($message);
        }

        return "Notifikasi berhasil dikirim.";
    }
}
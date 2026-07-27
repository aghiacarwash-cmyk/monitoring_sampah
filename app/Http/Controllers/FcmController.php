<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FcmController extends Controller
{
   public function saveToken(Request $request)
{
    $request->validate(['token' => 'required']);

    $idUser = session('id_user');

    if (!$idUser) {
        return response()->json(['success' => false, 'message' => 'Session login tidak ditemukan.'], 401);
    }

    DB::table('users')
        ->where('id_user', $idUser)
        ->update(['fcm_token' => $request->token]);

    return response()->json(['success' => true, 'message' => 'Token berhasil disimpan.']);
}
}
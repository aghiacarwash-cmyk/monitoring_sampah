<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================
    public function login()
    {
        return view('login');
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function authenticate(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    $email = trim($request->email);
    $password = trim($request->password);

    $user = DB::table('users')
        ->where('email', $email)
        ->first();

    if ($user) {

        $validPassword = false;

        // PASSWORD BCRYPT
        if (str_starts_with($user->password, '$2y$')) {

            $validPassword = Hash::check($password, $user->password);

        } 
        // PASSWORD BIASA
        else {

            $validPassword = ($password == $user->password);

        }

        // JIKA PASSWORD BENAR
        if ($validPassword) {

            $role = trim(strtolower($user->role));

            session([
                'id_user'       => $user->id_user,
                'username'      => $user->username,
                'nama_lengkap'  => $user->nama_lengkap,
                'email'         => $user->email,
                'foto'          => $user->foto,
                'role'          => $role,
                'login'         => true
            ]);

            // ADMIN
            if ($role == 'admin') {
                return redirect('/admin/dashboard');
            }

            // PETUGAS
            if ($role == 'petugas') {
                return redirect('/petugas/dashboard');
            }
        }
    }

    return back()->with('error', 'Email atau Password salah');
}
    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}
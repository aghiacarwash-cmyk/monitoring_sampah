<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetugasMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // CEK SUDAH LOGIN
        if (!session()->has('login')) {
            return redirect('/login');
        }

        // CEK ROLE PETUGAS
        if (session('role') != 'petugas') {
            return redirect('/login');
        }

        return $next($request);
    }
}
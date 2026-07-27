<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // BELUM LOGIN
        if (!session()->has('id_user')) {
            return redirect('/login');
        }

        // BUKAN ADMIN
        if (session('role') != 'admin') {
            return redirect('/login');
        }

        return $next($request);
    }
}
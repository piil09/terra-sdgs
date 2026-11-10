<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userToken = session('terra_user_token');
        $userRole = session('terra_user_role');

        if (!$userToken || $userRole !== 'user') {
            if (session('terra_admin_token')) {
                return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak: Akun Admin tidak dapat mengakses halaman khusus User.');
            }
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu sebagai User.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminToken = session('terra_admin_token');
        $adminRole = session('terra_admin_role');

        if (!$adminToken || $adminRole !== 'admin') {
            if (session('terra_user_token')) {
                return redirect()->route('user.profile')->with('error', 'Akses ditolak: Akun User biasa tidak dapat mengakses Portal Admin.');
            }
            return redirect()->route('admin.login')->with('error', 'Silakan masuk menggunakan akun Administrator.');
        }

        return $next($request);
    }
}

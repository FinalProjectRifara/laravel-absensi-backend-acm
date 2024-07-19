<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna telah diautentikasi dengan Sanctum
        if (Auth::guard('sanctum')->check()) {
            // Periksa peran pengguna
            if (Auth::guard('sanctum')->user()->role != 'admin' && Auth::guard('sanctum')->user()->role != 'supervisor') {
                // Jika peran bukan ADMIN, kembalikan respons atau alihkan
                return response()->json(['error' => 'Anda tidak memiliki akses.'], 403);
            }
        } else {
            // Jika pengguna tidak terautentikasi
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}

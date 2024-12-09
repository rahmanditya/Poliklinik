<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle($request, Closure $next)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        // Get the current user
        $user = Auth::user();

        // Check for admin access on admin routes
        if ($request->is('admin/*') && $user->role !== 'admin') {
            return redirect()->route('401')->withErrors(['error' => 'Unauthorized access.']);
        }

        // Check for pasien access on pasien routes
        if ($request->is('pasien/*') && $user->role !== 'pasien') {
            return redirect()->route('401')->withErrors(['error' => 'Unauthorized access.']);
        }

        // Check for dokter access on dokter routes
        if ($request->is('dokter/*') && $user->role !== 'dokter') {
            return redirect()->route('401')->withErrors(['error' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}

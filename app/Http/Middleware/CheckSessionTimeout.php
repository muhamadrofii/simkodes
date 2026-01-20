<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = $request->session()->get('last_activity', 0);
            $timeout = 7200; // 2 jam dalam detik

            if (time() - $lastActivity > $timeout) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // Perbarui waktu aktivitas
            $request->session()->put('last_activity', time());
        }

        return $next($request);
    }
}
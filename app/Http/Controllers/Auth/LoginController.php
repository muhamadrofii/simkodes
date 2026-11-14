<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Fail-safe: Pastikan user admin default selalu ada di staging/production
        $this->ensureDefaultAdminExists();

        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Fail-safe: Pastikan user admin default selalu ada di staging/production
        $this->ensureDefaultAdminExists();

        $email = trim($request->input('email'));
        $password = $request->input('password');

        // Cari user berdasarkan email atau nama
        $user = User::where('email', $email)
            ->orWhere('name', $email)
            ->first();

        // Jika input adalah 'admin', arahkan ke admin default jika belum ditemukan
        if (!$user && (strtolower($email) === 'admin' || str_contains($email, 'admin'))) {
            $user = User::where('email', 'admin@example.com')->first();
        }

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau akun "' . $email . '" tidak terdaftar di sistem.');
        }

        // Sinkronisasi otomatis untuk akun admin jika menggunakan password default
        if (
            (in_array($user->email, ['kdmpsranak@gmail.com', 'admin@example.com']) && $password === 'kopmerahputih') ||
            ($user->email === 'admin@test.com' && $password === 'password123')
        ) {
            $user->password = Hash::make($password);
            $user->save();
        } elseif (!Hash::check($password, $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Kata sandi yang Anda masukkan salah.');
        }

        // Login user dengan remember token selalu aktif (true)
        Auth::login($user, true);

        $request->session()->put('last_activity', time());
        $request->session()->save();

        // Bersihkan url.intended jika pernah mengarah ke login/logout
        session()->forget('url.intended');

        return redirect('/dashboard')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Pastikan akun admin default selalu tersedia dengan password valid
     */
    protected function ensureDefaultAdminExists(): void
    {
        try {
            User::updateOrCreate(
                ['email' => 'kdmpsranak@gmail.com'],
                [
                    'name' => 'Admin KDMPS Ranak',
                    'password' => Hash::make('kopmerahputih'),
                ]
            );

            User::updateOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Admin User',
                    'password' => Hash::make('kopmerahputih'),
                ]
            );

            User::updateOrCreate(
                ['email' => 'admin@test.com'],
                [
                    'name' => 'Admin QA Test',
                    'password' => Hash::make('password123'),
                ]
            );
        } catch (\Throwable $e) {
            Log::warning('Unable to auto-seed default admin: ' . $e->getMessage());
        }
    }
}

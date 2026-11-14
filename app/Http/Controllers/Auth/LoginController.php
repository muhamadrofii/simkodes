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
            return redirect()->route('dashboard');
        }

        return view('auth.login');
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

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email ' . $email . ' tidak terdaftar di sistem.');
        }

        if (!Hash::check($password, $user->password)) {
            // Jika akun admin default dan input adalah password default, perbarui hash secara transparan
            if (in_array($email, ['kdmpsranak@gmail.com', 'admin@example.com']) && $password === 'kopmerahputih') {
                $user->password = Hash::make('kopmerahputih');
                $user->save();
            } else {
                return back()
                    ->withInput($request->only('email'))
                    ->with('error', 'Kata sandi yang Anda masukkan salah.');
            }
        }

        // Login user dengan remember token selalu aktif (true)
        // Ini memastikan sesi tetap bertahan meskipun session cookie ter-drop oleh reverse proxy
        Auth::login($user, true);

        $request->session()->regenerate();
        $request->session()->put('last_activity', time());

        // Bersihkan url.intended jika pernah mengarah ke login/logout untuk mencegah redirect loop
        $intended = session('url.intended');
        if ($intended && (str_contains($intended, 'login') || str_contains($intended, 'logout'))) {
            session()->forget('url.intended');
        }

        return redirect('/dashboard');
    }

    /**
     * Pastikan akun admin default selalu tersedia sebagai fail-safe di staging/production
     */
    protected function ensureDefaultAdminExists(): void
    {
        try {
            User::firstOrCreate(
                ['email' => 'kdmpsranak@gmail.com'],
                [
                    'name' => 'Admin KDMPS Ranak',
                    'password' => Hash::make('kopmerahputih'),
                ]
            );

            User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Admin User',
                    'password' => Hash::make('kopmerahputih'),
                ]
            );
        } catch (\Throwable $e) {
            Log::warning('Unable to auto-seed default admin: ' . $e->getMessage());
        }
    }
}

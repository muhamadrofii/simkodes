<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login'); // pastikan file view-nya sesuai
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('last_activity', time());
            return redirect()->intended('/dashboard');
        }

        // Jika gagal
        return back()->with('error', 'Email atau password salah.');
    }

}



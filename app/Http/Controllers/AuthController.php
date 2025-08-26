<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            dd('Login berhasil sebagai', Auth::user());
            // redirect sesuai role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard')->with('ok', 'Selamat datang Admin');
            } elseif ($user->role === 'manager') {
                return redirect()->route('dashboard')->with('ok', 'Selamat datang Manager Gudang');
            } else {
                return redirect()->route('dashboard')->with('ok', 'Selamat datang Staff Gudang');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

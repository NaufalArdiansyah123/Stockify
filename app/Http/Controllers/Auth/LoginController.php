<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

         if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect berdasarkan role - LANGSUNG KE DASHBOARD
            if ($user->role === 'manager') {
                return redirect()->route('manager.dashboard');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.dashboard');
            }
            
            // Fallback jika role tidak dikenali
            return redirect('/');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

   protected function authenticated($request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->route('dashboard');
    }

    if ($user->role === 'manager') {
        return redirect()->route('/manager/dashboard'); // bisa diarahkan ke halaman laporan
    }

    if ($user->role === 'staff') {
        return redirect()->route('/staff/dashboard'); // bisa diarahkan ke halaman stok
    }
}


// protected function redirectTo()
// {
//     $role = auth()->user()->role;

//     switch ($role) {
//         case 'admin':
//             return '/admin/dashboard';
//         case 'manajer':
//             return '/manajer/dashboard';
//         case 'staff':
//             return '/staff/dashboard';
//         default:
//             return '/home';
//     }
// }


}

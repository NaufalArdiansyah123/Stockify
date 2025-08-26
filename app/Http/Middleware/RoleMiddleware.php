<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = strtolower(auth()->user()->role);   // 🔑 pastikan lowercase
        $roles = array_map('strtolower', $roles);       // 🔑 samakan ke lowercase

        // Jika admin, bypass semua pengecekan role
        if ($userRole === 'admin') {
            return $next($request);
        }

        if (!in_array($userRole, $roles)) {
            abort(403, 'Anda tidak punya akses.');
        }

        return $next($request);
    }
}

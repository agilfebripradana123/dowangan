<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // pakai: role:admin atau role:admin,pemuda
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role, $roles, true)) {
            // hard block dari backend (ketik URL juga mentok)
            abort(404); // (bisa ganti 403 kalau mau)
        }

        return $next($request);
    }
}

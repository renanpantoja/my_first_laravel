<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilamentAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('filament')->user();

        if (! $user || ! $user->is_admin) {
            Auth::guard('filament')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            abort(403, 'Access denied: Not administrator.');
        }

        return $next($request);
    }
}
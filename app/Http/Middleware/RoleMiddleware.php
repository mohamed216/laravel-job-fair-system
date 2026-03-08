<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($role === 'admin' && $user->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Access denied');
        }

        if ($role === 'company' && $user->role !== 'company') {
            return redirect()->route('dashboard')->with('error', 'Access denied');
        }

        return $next($request);
    }
}

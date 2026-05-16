<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== $role) {
            // If admin tries to access client routes, redirect to admin
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // If client tries to access admin routes, redirect to home
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        return $next($request);
    }
}

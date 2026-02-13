<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next, string $guard = 'admin'): Response
    {
        if (! Auth::guard($guard)->check()) {
            return redirect()->guest(route('admin.login'));
        }

        return $next($request);
    }
}

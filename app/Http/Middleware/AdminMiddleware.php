<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role->name === "admin") {
            return redirect('/admin');
        }
        return $next($request);
    }
}

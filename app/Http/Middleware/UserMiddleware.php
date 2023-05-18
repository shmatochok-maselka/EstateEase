<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role->name === "user") {
            return redirect('/user');
        }
        return $next($request);
    }
}

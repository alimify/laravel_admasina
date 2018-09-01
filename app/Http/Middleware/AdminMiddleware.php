<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return Auth::check() && isset(Auth::user()->role) && isset(Auth::user()->role->id) && Auth::user()->role->id == 1 ? $next($request) : redirect()->route('login');
    }
}

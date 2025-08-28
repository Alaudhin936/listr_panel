<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgencyGuestMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('agency.dashboard')->with('info', 'You are already logged in.');
        }
        return $next($request);
    }
}

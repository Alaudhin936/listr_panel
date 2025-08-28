<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgentGuestMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('agent')->check()) {
            return redirect()->route('login')->with('info', 'You are already logged in.');
        }
        return $next($request);
    }
}

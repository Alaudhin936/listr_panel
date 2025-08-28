<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AgentAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('agent')->check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        return $next($request);
    }
}

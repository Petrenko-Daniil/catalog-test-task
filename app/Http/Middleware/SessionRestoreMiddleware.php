<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionRestoreMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('session_id')){
            session()->setId($request->get('session_id'));
        }
        return $next($request);
    }
}

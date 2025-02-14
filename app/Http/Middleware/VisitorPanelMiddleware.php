<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VisitorPanelMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            return $next ($request);
        } else {
            return redirect('/auth/login');        
        }
    }
}
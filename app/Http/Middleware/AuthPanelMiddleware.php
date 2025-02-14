<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthPanelMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            switch ($user->role) {
                case 'administrator':
                    return redirect('/admin');
                case 'officer':
                    return redirect('/officer');
                case 'visitor':
                    return redirect('/visitor');
            }
        } else {
            return $next($request);
        }
    }
}
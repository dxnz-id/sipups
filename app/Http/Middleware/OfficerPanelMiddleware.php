<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OfficerPanelMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            switch ($user->role) {
                case"administrator":
                    return $next ($request);
                case 'officer':
                    return $next ($request);
                case 'visitor':
                    return redirect('/visitor');
            }
        } else {
            return redirect('/auth/login');        
        }
    }
}
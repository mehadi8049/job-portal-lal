<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $redirectTo = 'dashboard';
            switch (Auth::user()->role) {
                case 'employer':
                    $redirectTo = 'company/dashboard';
                    break;
                case 'admin':
                    $redirectTo = 'settings/dashboard';
                    break;
                default:
                    $redirectTo = 'dashboard';
                    break;
            }
            return redirect($redirectTo);
        }

        return $next($request);
    }
}

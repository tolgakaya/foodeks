<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RoleConstant;

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
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
        // if (Auth::user()->role == RoleConstant::ROLE_ADMIN) {
        //     return redirect()->route('admin.dashboard');
        // } else if (Auth::user()->role == RoleConstant::ROLE_CUSTOMER) {
        //     return redirect()->route('customer.dashboard');
        // }
        // return $next($request);
    }
}
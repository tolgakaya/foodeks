<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RoleConstant;

class Admin
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == RoleConstant::ROLE_ADMIN || Auth::user()->role == RoleConstant::ROLE_MANAGER) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
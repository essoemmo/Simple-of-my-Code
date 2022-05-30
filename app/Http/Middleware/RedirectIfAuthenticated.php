<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect('admin/home');
            }
              break;
              
            case 'restaurant':
            if (Auth::guard($guard)->check()) {
                return redirect('restaurant/home');
            }
              break;

            default:
            if (Auth::guard($guard)->check()) {
                return redirect('/home');
            }
              break;
          }

        return $next($request);
    }
}
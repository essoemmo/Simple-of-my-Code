<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Lang
{
    public function handle(Request $request, Closure $next)
    {
        $request->header('lang') == 'en' ? app()->setLocale('en') : app()->setLocale('ar');
			return $next($request);
    }
}

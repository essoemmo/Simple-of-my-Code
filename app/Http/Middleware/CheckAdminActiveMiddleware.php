<?php

namespace App\Http\Middleware;

use App\Enums\Options\StatusEnum;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;

class CheckAdminActiveMiddleware
{
    use ResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        $admin = auth('admin')->user();
        // Check if the admin is logged in
        if ($admin) {
            // Check if the admin is active and verified
            if ($admin->status == StatusEnum::active->value) {
                return $next($request);
            } else {
                auth('admin')->logout();

                return self::failResponse(422, $admin->refuse_reason);
            }
        }

        // Redirect to the login page if the admin is not logged in
        return self::failResponse(422, $admin->refuse_reason);
    }
}

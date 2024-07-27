<?php

namespace App\Http\Middleware;

use App\Enums\Options\StatusEnum;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;

class CheckUserActiveMiddleware
{
    use ResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        $user = auth('api')->user();
        // Check if the user is logged in
        if ($user) {
            // Check if the user is active and verified
            if ($user->status == StatusEnum::active->value) {
                return $next($request);
            } else {
                auth('api')->logout();

                return self::failResponse(422, $user->refuse_reason);
            }
        }

        // Redirect to the login page if the user is not logged in
        return self::failResponse(422, $user->refuse_reason);
    }
}

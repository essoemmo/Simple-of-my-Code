<?php

namespace App\Services;

use App\Enums\Options\StatusEnum;
use App\Enums\Users\UserTypeEnum;
use App\Mail\Auth\PasswordRecoveryMail;
use App\Models\Users\Admin;
use App\Models\Users\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    use ResponseTrait;

    public function validateAdmin($admin, $password): ?JsonResponse
    {
        $password = !Hash::check($password, $admin->password);
        return match (true) {
            !$admin, $password => self::failResponse(422, __('application.unauthorized')),
            !$admin->is_verified => self::failResponse(420, __('application.not_verified')),
//            !$admin->is_active => self::failResponse(422, __('application.not_active')),

            default => null
        };
    }

    public function validateUser(array $credentials, $user): ?JsonResponse
    {
        $user = User::whereEmail($credentials['email'])->first();
        $password = !Hash::check($credentials['password'], $user->password);
        return match (true) {
            !$user, $password, $user->is_deleted == 1 => self::failResponse(422, __('application.unauthorized')),
            !$user->is_verified => self::failResponse(420, __('application.not_verified')),
            !$user->is_active => self::failResponse(422, __('application.not_active')),
             $user->type?->value === UserTypeEnum::instructor->value && $user->status?->value === StatusEnum::pending->value => self::failResponse(422, __('application.not_allowed')),
            default => null
        };
    }
    public  function SendMailVerificationCode(string $email,int $code):void
    {
        Mail::to($email)->send(new PasswordRecoveryMail($code));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminResetCodeRequest;
use App\Http\Requests\Auth\AdminResetPasswordRequest;
use App\Http\Requests\Auth\AdminVerifyRequest;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Http\Resources\Users\AdminResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\Admin;
use App\Services\AuthService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseTrait;

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AdminLoginRequest $request)
    {
        $admin = Admin::whereEmail($request->email)->first();
        $validationResult = $this->authService->validateAdmin($admin, $request->password);

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $admin->fcmTokens()->firstOrCreate(['fcm_token' => $request->fcm_token]);
        $admin->access_token = $admin->createToken('PersonalAccessToken')->plainTextToken;

        return self::successResponse(__('application.login_successfully'), AdminResource::make($admin));
    }

    public function verify(AdminVerifyRequest $request): JsonResponse
    {
        $admin = Admin::whereCode($request->code)->first();

        if ($admin->code != $request->code) {
            return self::failResponse(422, __('application.wrong_code'));
        }

        $admin->update(['is_verified' => 1]);
        $admin->access_token = $admin->createToken('PersonalAccessToken')->plainTextToken;

        return self::successResponse(__('application.verified'), AdminResource::make($admin));
    }

    public function resetCode(AdminResetCodeRequest $request): JsonResponse
    {
        $admin = Admin::whereEmail($request->email)->first();
        $admin->update(['code' => generate_verification_code()]);

        return self::successResponse(__('application.resend_code'), AdminResource::make($admin));
    }

    public function resendCode(Request $request): JsonResponse
    {
        $admin = Admin::whereEmail($request->email)->first();
        $admin->update(['code' => generate_verification_code()]);
        return self::successResponse(__('application.resend_code'), AdminResource::make($admin));
    }

    public function resetPassword(AdminResetPasswordRequest $request): JsonResponse
    {
        $admin = Admin::whereEmail($request->email)->first();
        $admin->update(['password' => bcrypt($request->password)]);
        return self::successResponse(__('application.password_updated'), AdminResource::make($admin));
    }

    public function profile(): JsonResponse
    {
        return self::successResponse(data: UserResource::make(auth('admin')->user()));
    }

    public function logout(Request $request)
    {
        auth('admin')->user()->currentAccessToken()->delete();
        auth('admin')->user()->fcmTokens()->whereFcmToken($request->fcm_token)->delete();

        return self::successResponse(__('application.log_out'));
    }
    public function adminDelete(): JsonResponse
    {
        auth('admin')->user()->update(['is_deleted' => 1]);

        return self::successResponse(message: __('application.deleted'));
    }
}

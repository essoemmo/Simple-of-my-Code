<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Http\Requests\Users\UserResetPasswordRequest;
use App\Http\Requests\Users\UserVerifyRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    use ResponseTrait;

    private UserService $userService;
    private AuthService $authService;

    public function __construct(UserService $userService, AuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }


    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $userData = $request->safe()->only('name', 'phone', 'email', 'nationality_id','type');
            $userDetailsData = $request->safe()->except('name', 'phone', 'email', 'nationality_id','type');

            $userData['password'] = bcrypt($request->password);
            $userData['code'] = generate_verification_code();

            $user = $this->userService->createUser($userData, $userDetailsData, $request->attachments);

            $user->access_token = $user->createToken('PersonalAccessToken')->plainTextToken;
            //$this->authService->SendMailVirficationCode($UserData->email, $activation_code);
            DB::commit();

            return self::successResponse(__('application.must_verify'), UserResource::make($user));
        } catch (Exception $e) {
            DB::rollBack();
        }

    }


    public function verify(UserVerifyRequest $request): JsonResponse
    {
        $user = User::whereCode($request->code)->first();

        if ($user->code != $request->code) {
            return self::failResponse(422, __('application.wrong_code'));
        }

        $user->update(['is_verified' => true]);
        $user->access_token = $user->createToken('PersonalAccessToken')->plainTextToken;

        return self::successResponse(__('application.verified'), UserResource::make($user));
    }


    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::whereEmail($request->email)->first();

        $validationResult = $this->authService->validateUser($credentials, $user);

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

//       $user->fcmTokens()->firstOrCreate(['fcm_token' => $request['fcm_token']]);
        $user->access_token = $user->createToken('PersonalAccessToken')->plainTextToken;

        return self::successResponse(__('application.login_successfully'), UserResource::make($user));

    }


    public function logout(Request $request)
    {
        auth('api')->user()->currentAccessToken()->delete();
        //auth('api')->user()->fcmTokens()->whereFcmToken($request->fcm_token)->delete();

        return self::successResponse(__('application.log_out'));
    }

    public function profile(): JsonResponse
    {
        return self::successResponse(data: UserResource::make(auth('api')->user()));
    }


    public function resendCode(Request $request): JsonResponse
    {
        $user = User::whereEmail($request->email)->first();
        $user->update(['code' => generate_verification_code()]);

        return self::successResponse(__('application.resend_code'), UserResource::make($user));
    }


    public function resetPassword(UserResetPasswordRequest $request): JsonResponse
    {
        $user = User::whereEmail($request->email)->first();
        $user->update(['password' => bcrypt($request->password)]);

        return self::successResponse(__('application.password_updated'), UserResource::make($user));
    }

    public function deleteUser(): JsonResponse
    {
        auth('api')->user()->update(['is_deleted' => 1]);
        return self::successResponse(message: __('application.deleted'));
    }



}

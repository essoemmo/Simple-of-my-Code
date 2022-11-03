<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginUserResquest;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Requests\API\ResetCodeResquest;
use App\Http\Requests\API\UpdatePasswordRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Requests\API\VerifyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use App\Traits\ResponseTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseTrait;

    public function Register(RegisterRequest $request)
    {
        
        $userData  = $request->safe()->except(['image','password','commercial']);

        $userData['image']      = UploadImage($request->image,'users');
        $userData['commercial'] = UploadFile($request->commercial,'users');
        $userData['password']   = bcrypt($request->password);
        $userData['code']       = mt_rand(1000, 9999);

        $user = User::create($userData);
        // $userMailData = [
        //     'title' => 'تفعيل الحساب الخاص بك',
        //     'body'  =>  'يرجى تفعيل الحساب الخاص بك عن طريق كتابه الكود الخاص بك فى حقل الكود .. اذا واجهتكم اى مشاكل يرجى التواصل مع اداره التطبيق',
        //     'code' => $user->code,
        // ];

       // Mail::to($user->email)->send(new UserMail($userMailData));
        return self::successResponse(__('application.mustverfiy'),UserResource::make($user));
    }

    public function verify(VerifyRequest $request)
    {
        $user = User::find($request->id);

        if ($user->code != $request->code) {
             return self::faildResponse(422,__('application.wrongcode'));
        }

        $user->update(['is_verified' => 1]);
        $user->tokens()->delete();
        return self::successResponse(__('application.verfied'),UserResource::make($user));
    }

    public function resetCode(ResetCodeResquest $request)
    {
      $user = User::where('email',$request->email)->first();
      $user->update(['code' => mt_rand(1000, 9999)]);

    //   $userMailData = [
    //         'title' => 'تفعيل الحساب الخاص بك',
    //         'body'  =>  'يرجى تفعيل الحساب الخاص بك عن طريق كتابه الكود الخاص بك فى حقل الكود .. اذا واجهتكم اى مشاكل يرجى التواصل مع اداره التطبيق',
    //         'code'  => $user->code,
    //   ];

    //   Mail::to($user->email)->send(new UserMail($userMailData));
      return self::successResponse(__('application.resetcode'),UserResource::make($user));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::find($request->id);
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return self::successResponse(__('application.passwordupdated'),UserResource::make($user));
    }

    public function login(LoginUserResquest $request)
    {
        $credentials = request(['email', 'password']);
        
        if (!Auth::attempt($credentials))
            return self::faildResponse(422, __('application.unauthorized'));

        $user = $request->user();
        $user->update(['google_token' => $request->google_token]);

        if (auth('api')->user()->is_verified == 0){
            return self::successResponse(__('application.notverfied'),UserResource::make($user));
        }

        if (auth('api')->user()->active == 0) {
            return self::successResponse(__('application.notactive'));
        }


        return self::successResponse(__('application.loginsuccessfully'),UserResource::make($user));


    }

}

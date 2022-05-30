<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserResquest;
use App\Http\Requests\User\RegUserRequest;
use App\Http\Requests\User\ResetCodeResquest;
use App\Http\Requests\User\UpdateLocationRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserPassword;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\VerifyUserResquest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function Register(RegUserRequest $request)
    {        
        $user = User::create([
            'name'         => $request->name,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'code'         => mt_rand(1000, 9999),
            'lat'          => $request->lat,
            'lang'         => $request->lang,
            'address'      => $request->address,
            'google_token' => $request->google_token,
        ]);

        if ($user == true) {
            return response()->json([
                'success' => 1,
                'message' => __('application.mustverfiy'),
                'code'    => $user->code,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

    public function verify(VerifyUserResquest $request)
    {
          $user = User::where('phone', $request->phone)->first();
          if ($user->code != $request->code) {
              return response()->json([
                  'success' => 0,
                  'message' =>  __('application.wrongcode')
                ], 400);
            }
            if ($user == true) {     
            $user->update(['isVerified' => true]);
            Auth::login($user);
            $token = $user->createToken('PersonalAccessToken')->plainTextToken;
            return response()->json([
                'success'      => 1,
                'message'      => __('application.verfied'),
                'type'         => 'user',
                'token_type'   => 'Bearer',
                'user_id'      =>  $user->id,
                'access_token' => $token,
                'google_token' => $user->google_token,
            ], 200);
            } else {
            return response()->json([
                'success' => 0,
                'message' =>  __('application.errorhere')
            ], 400);
             }
    }

    public function resetCode(ResetCodeResquest $request)
    {
      $user = User::where('phone', $request->phone)->first();
       if($user){ 
        return response()->json([
            'success' => 1,
            'message' => __('application.codereset'),
            'user_id' =>  $user->id,
            'phone'   => $user->phone,
            'code'    => mt_rand(1000, 9999),
        ], 200);
        }else{
        return response()->json([
            'success' => 0,
            'message' =>  __('application.errorhere')
        ], 400);
        }
    }

    public function UpdatePassword(UpdatePasswordRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        $user->update([
            'code'     => $request->code,
            'password' => Hash::make($request->password),
        ]);
        if($user){ 
            return response()->json([
                'success' => 1,
                'message' => __('application.passwordupdated'),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

    public function login(LoginUserResquest $request)
    {
        $credentials = request(['phone', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'success' => 0,
                'message' => __('application.unauthorized')
            ], 422);

            if (auth('api')->user()->isVerified == 0){
            return response()->json([
                'success' => 0,
                'message' => __('application.notverfied')
            ], 400);
            }
            
            if (auth('api')->user()->active == 0) {
            return response()->json([
                'success' => 0,
                'message' => __('application.notactive')
            ], 400);
            }
            
            $user = $request->user();
            $user->update(['google_token' => $request->google_token]);
            $token = $user->createToken('PersonalAccessToken')->plainTextToken;

            return response()->json([
                'success'      => 1,
                'message'      => __('application.loginsuccessfully'),
                'token_type'   => 'Bearer',
                'type'         => 'user',
                'user'         => auth()->user()->id,
                'google_token' => $user->google_token,
                'access_token' => $token,
            ], 200);
            
        
    }

    public function logout(Request $request)
    {
       $user = $request->user()->tokens()->delete();
            if ($user) {
                return response()->json([
                    'success' => 1,
                    'message' => __('application.loggedout')
                ],200);
            }else {
                return response()->json([
                    'success' => 0,
                    'message' => __('application.errorhere')
                ],400);
            }

    }

    public function UserProfile()
    {
        return response()->json(UserResource::make(auth('api')->user()));
    }

    public function UpdateProfile(UpdateUserRequest $request)
    {
        $user = auth('api')->user()->id;
        $user = User::findOrFail($user);
        $user->update($request->all());
        if ($request->image) {
            $user->update(['image' => UploadImage($request->image,'users')]);
        }
        if ($user == true) {
            return response()->json([
                'success' => 1,
                'message' => __('application.updated'),
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

    public function UpdateUserPassword(UpdateUserPassword $request)
    {
      $user = auth('api')->user();
      $user = User::findOrFail($user->id);
      if (Hash::check($request->old_password, $user->password)) {
        $user->fill([
            'password' => Hash::make($request->password)
          ])->save();

        return response()->json([
             'success' => 1,
             'message' => __('application.updated')
        ],200);
      }else {
        return response()->json([
            'success' => 0,
            'message' => __('application.oldpass')
        ],400);
       }
    }

    public function updateLocation(UpdateLocationRequest $request)
    {
        $user = auth('api')->user();
        $user = User::findOrFail($user->id);
        $user->update(['lat' => $request->lat, 'lang' => $request->lang]);
        if ($user == true) {
            return response()->json([
                'success' => 1,
                'message' => __('application.updated'),
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

}

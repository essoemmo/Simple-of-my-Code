<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\LoginRestaurantRequest;
use App\Http\Requests\Restaurant\RegRestaurantRequest;
use App\Http\Requests\Restaurant\ResetCodeRequest;
use App\Http\Requests\Restaurant\UpdatePasswordRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantPassword;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Http\Requests\Restaurant\VerifyRestuarantRequest;
use App\Http\Resources\RestaurantProfileResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuthRestaurantController extends Controller
{
    public function register(RegRestaurantRequest $request)
    {
        $restaurant = Restaurant::create([
            'name'         => $request->name,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'code'         => mt_rand(1000, 9999),
            'lat'          => $request->lat,
            'lang'         => $request->lang,
            'address'      => $request->address,
            'from'         => date("H:i", strtotime("$request->from")),
            'to'           => date("H:i", strtotime("$request->to")),
            'google_token' => $request->google_token,
            'image'        => UploadImage($request->image,'restaurants'),
            'cover'        => UploadImage($request->cover,'restaurants'),
           // 'type_place_id' => $request->type_place_id,
            'resrv_numb'   => $request->res_ber_hour,
        ]);

        QrCode::size(450)->format('png')->generate($restaurant->id, 'images/'.$restaurant->id.'.png');

        if ($restaurant == true) {
            return response()->json([
                'success' => 1,
                'message' => __('application.mustverfiy'),
                'code'    => $restaurant->code,
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

    public function verify(VerifyRestuarantRequest $request)
    {
          $restaurant = Restaurant::where('phone', $request->phone)->first();
          if ($restaurant->code != $request->code) {
              return response()->json([
                  'success' => 0,
                  'message' =>  __('application.wrongcode')
                ], 400);
           }else{     
            $restaurant->update(['isVerified' => true]);
            Auth::login($restaurant);
            $token = $restaurant->createToken('PersonalAccessToken')->plainTextToken;
            return response()->json([
                'success' => 1,
                'message' => __('application.verfied'),
                'type' => 'restaurant',
                'message' => __('application.mustverfiy'),
                'token_type' => 'Bearer',
                'restaurant_id' =>  $restaurant->id,
                'access_token' => $token,
                'google_token' => $restaurant->google_token,
            ], 200);
            }
    }

    public function resetCode(ResetCodeRequest $request)
    {
      $restaurant = Restaurant::where('phone', $request->phone)->first();
       if($restaurant){ 
        return response()->json([
            'success' => 1,
            'message' => __('application.codereset'),
            'restaurant_id' =>  $restaurant->id,
            'phone' => $restaurant->phone,
            'code' => mt_rand(1000, 9999),
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
        $restaurant = Restaurant::where('phone', $request->phone)->first();

        $restaurant->update([
            'code'     => $request->code,
            'password' => Hash::make($request->password),
        ]);
        if($restaurant){ 
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

    public function login(LoginRestaurantRequest $request)
    {
        $restaurant = Restaurant::where('phone', $request->phone)->first();
        
           if ($restaurant == null)
            return response()->json([
                'success' => 0,
                'message' => __('application.unauthorized')
            ], 422);

            if (!Hash::check($request->password, $restaurant->password))
            return response()->json([
                'success' => 0,
                'message' => __('application.unauthorized')
            ], 422);

            if ($restaurant->isVerified == 0){
            return response()->json([
                'success' => 0,
                'message' => __('application.notverfied')
            ], 400);
            }
            
            if ($restaurant->active == 0) {
            return response()->json([
                'success' => 0,
                'message' => __('application.notactive')
            ], 400);
            }
            
            $restaurant->update(['google_token' => $request->google_token]);
            $token = $restaurant->createToken('PersonalAccessToken')->plainTextToken;

            return response()->json([
                'success' => 1,
                'message' => __('application.loginsuccessfully'),
                'token_type' => 'Bearer',
                'type' => 'restaurant',
                'user' => $restaurant->id,
                'google_token' => $restaurant->google_token,
                'access_token' => $token,
            ], 200);
            
        
    }

    public function logout(Request $request)
    {
       $restaurant = $request->user()->tokens()->delete();
            if ($restaurant) {
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

    public function RestaurantProfile()
    {
        return response()->json(RestaurantProfileResource::make(auth('restaurant-api')->user()));
    }


    public function UpdateProfile(UpdateRestaurantRequest $request)
    {
        $restaurant = auth('restaurant-api')->user()->id;
        $restaurant = Restaurant::findOrFail($restaurant);
        $restaurant->update($request->all());
        if ($request->image) {
            $restaurant->update(['image' => UploadImage($request->image,'restaurants')]);
        }
        if ($request->cover) {
            $restaurant->update(['cover' => UploadImage($request->cover,'restaurants')]);
        }
        if ($restaurant == true) {
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

    public function UpdateRestaurantPassword(UpdateRestaurantPassword $request)
    {
        $restaurant = auth('restaurant-api')->user();
        $restaurant = Restaurant::findOrFail($restaurant->id);
        if (Hash::check($request->old_password, $restaurant->password)) {
            $restaurant->fill([
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
 
    }

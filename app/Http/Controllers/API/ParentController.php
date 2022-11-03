<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\RechargeResource;
use App\Http\Resources\UserResource;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    use ResponseTrait;

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = auth('api')->user();

        $userData = $request->safe()->except(['image','password']);
        if($request->image)
            $userData['image']  = UploadImage($request->image,'users');
        if($request->password)
            $userData['password'] = bcrypt($request->password);

        $user->update($userData);
        return self::successResponse(__('application.updated'),UserResource::make($user));
    }

    public function transactions()
    {
        return self::successResponse('' , RechargeResource::collection(auth()->user()->charges()->latest()->get()));
    }
}

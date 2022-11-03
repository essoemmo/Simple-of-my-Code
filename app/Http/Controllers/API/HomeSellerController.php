<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KidResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HomeSellerController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $data = OrderResource::collection(Order::where('user_id', auth()->user()->id)->get());
        $balance = User::where('id', auth()->user()->id)->value('balance');

        return self::successResponse('',['balance'=>$balance , 'orders'=>$data]);
    }

    public function getKid($id)
    {
        $data = new UserResource(User::find($id));
        return self::successResponse('',$data);
    }

    public function drawRequest()
    {
        $seller = auth('api')->user();
        $seller->is_draw = 1;
        $seller->save();
        return self::successResponse(__('applications.added'));
    }
}

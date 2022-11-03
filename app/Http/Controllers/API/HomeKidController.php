<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersKidResource;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HomeKidController extends BaseController
{
    use ResponseTrait;
    public function index(){
        $data = OrderResource::collection(Order::where('kid_id', auth()->user()->id)->get());

        return self::successResponse('' , $data);
    }
}

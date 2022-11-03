<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderKidResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    use ResponseTrait;

    public function post(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'products'         => 'required|array',
                'kid_id'       => 'required|exists:users,id',
                'total'        => 'required|',
                'lat'          => 'required|',
                'lang'          => 'required|',
            ]);
            if ($validator->fails()) {
                return self::faildResponse(422 , $validator->errors()->first());
            }

            $order = Order::create(['user_id' => auth()->user()->id, 'kid_id' => $request->kid_id, 'total' =>  $request['total'] ,'lat'=>$request->lat , 'lang'=>$request->lang]);

            $user = User::find(auth()->user()->id);
            $user->balance = $user->balance + $request['total'];
            $user->save();

            $user = User::find($request->kid_id);
            $user->balance = $user->balance - $request['total'];
            $user->save();

            foreach ($request->products as $product) {
                $order->products()->create($product);
            }

            
            
            DB::commit();
            return self::successResponse(__('application.added') , OrderResource::make($order));
        } catch (\Exception $e) {
            return $e;
            DB::rollback();
            // something went wrong
        }
    }

    public function order($id)
    {
        $data = new OrderResource(Order::find($id));
        return self::successResponse('' , $data);
    }

    public function order_kid($id)
    {
        $order = Order::find($id);
        $data = new OrderResource(Order::find($id));
        return self::successResponse('' , $data);
    }
}

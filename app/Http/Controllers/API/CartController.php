<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddCartRequest;
use App\Http\Requests\User\DeleteCartRequest;
use App\Http\Requests\User\UpdateQtyRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function addToCart(AddCartRequest $request)
    {
        $user = auth('api')->user();
        $type = Type::where('id',$request->type_id)->select('price')->first();
        $product = Product::where('id',$request->product_id)->select('main_price','restaurant_id')->first();
        $usercarts = $user->carts()->where('product_id',$request->product_id)->where('type_id',$request->type_id)->count();
        $usecar= $user->carts()->first();

        if ($usercarts) {
            return response()->json([
                'success' => 0,
                'message' => __('application.addbefor')
            ], 400);
        }

        if ($usecar && $usecar->restaurant_id !=  $product->restaurant_id) {
            return response()->json([
                'success' => 0,
                'message' => __('application.deletecart')
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'restaurant_id' => $request->restaurant_id,
            'type_id' => $request->type_id ? $request->type_id :null,
            'qty' => $request->qty,
            'sub_total' => $type ? ($type->price * $request->qty) : ($product->main_price * $request->qty),
        ]);

        return response()->json([
            'success' => 1,
            'message' => __('application.added'),
        ], 200);

    }

    public function SmallCartDetails()
    {
        $user = auth('api')->user();
        $count_products = $user->carts->count();
        $total_products = $user->carts->sum('sub_total');
        if($user){
            return response()->json([
                'count_products' => $count_products,
                'total_products' => $total_products,
            ], 200);
        }
    }

    public function CartDetails()
    {
        $user = auth('api')->user();
        if ($user) {
            return response()->json([
              'success'       => 1,
              'cart'          => CartResource::collection($user->carts),
              'sub_total'     => $user->carts->sum('sub_total'),
              'restaurant_id' => $user->carts()->first() ? $user->carts()->first()->restaurant_id : null,
            ], 200);
          }
    }

    public function DeleteCarts()
    {
        $user = auth('api')->user();
        foreach ($user->carts as $value) {
            $value->delete();
        }
        if ($user) {
            return response()->json([
                'success' => 1,
                'message' => __('application.deleted'),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere'),
            ], 400);
        }
    }

    public function UpdateQty(UpdateQtyRequest $request)
    {
       $cart = Cart::findOrFail($request->id);
       $price = $cart->sub_total / $cart->qty;
       $subtotal = $request->qty * $price;
       $cart->update([
            'qty'       => $request->qty,
            'sub_total' => $subtotal 
          ]);

        if ($cart) {
            return response()->json([
                'success' => 1,
                'message' => __('application.updated'),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere'),
            ], 400);
        }

    }

    public function DeleteCart(DeleteCartRequest $request)
    {
        $cart = Cart::findOrFail($request->id);
        $cart->delete();
        if ($cart) {
            return response()->json([
                'success' => 1,
                'message' => __('application.updated'),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere'),
            ], 400);
        }

    }

}

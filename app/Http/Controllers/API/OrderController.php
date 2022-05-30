<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddOrderRequest;
use App\Http\Requests\User\CancelOrderRequest;
use App\Http\Requests\User\DiscountRequest;
use App\Http\Requests\User\TakeCheckRequest;
use App\Http\Resources\OrderStatusResource;
use App\Http\Resources\OrderTypeResource;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\OrderType;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\User;
use App\Notifications\ApprovedStatus;
use App\Notifications\CanceledStatus;
use App\Notifications\PendingStatus;
use App\Notifications\RejectedStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function CheckTakeOrder(TakeCheckRequest $request)
    {
      return response()->json(['success' => 1,], 200);
    }

    public function AddOrder(Request $request)
    {
        $user = auth('api')->user();
        
        if ($user->carts->isEmpty()) {
          return response()->json([
            'success' => 0,
            'message' => __('application.emptycart')
        ], 400);
      }
        $order = Order::create([
          'user_id'         => $user->id,
          'restaurant_id'   => $request->restaurant_id,
          'reservation_id'  => $request->reservation_id,
          'order_status_id' => 1,
          'order_type_id'   => $request->order_type_id,
          'date'            => $request->date,
          'time'            => $request->time ? date("H:i", strtotime(convert2english($request->time))) : null,
          'type_place_id'   => $request->type_place_id,
          'table_number'    => $request->table_number,
          'note'            => $request->note,
        ]);

        if ($order->exists()) {

          foreach ($user->carts as $product) {

          $order_details = OrderDetail::create([
              'order_id'      => $order->id,
              'restaurant_id' => $product['restaurant_id'],
              'product_id'    => $product['product_id'],
              'type_id'       => $product['type_id'],
              'qty'           => $product['qty'],
              'sub_total'     => $product['sub_total'],
          ]);
          } 
            $order_sub_total = OrderDetail::where('order_id',$order->id)->sum('sub_total');
            $order->update([
                'sub_total' => $order_sub_total,
                'total'     => $order_sub_total,
              ]);
        }
        
        foreach ($user->carts as $value) {
          $value->delete();
        }

        $restaurant = Restaurant::find($order->restaurant_id);
        $details = [
          'title_en' => 'New Order',
          'body_en'  => 'new order wait for approved',
          'title_ar' => 'طلب جديد',
          'body_ar'  => 'لديك طلب جديد ينتظر الموافقة',
        ];

        $restaurant->notify(new PendingStatus($details));

        if($order_details){
            return response()->json([
                'success' => 1,
                'message' => __('application.added'),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }

    }

    public function discountCoupon(DiscountRequest $request)
    {
        $user = auth('api')->user();
        $order = Order::findOrFail($request->order_id);
        $coupon = Coupon::where('code',$request->code)->where('to','>=',Carbon::now()->format('Y-m-d'))->first();
        $orders = $user->orders()->where('coupon_id', $coupon->id)->count();

        if ($orders > 0) {
            return response()->json([
                'success' => 0,
                'message' => __('application.couponused')
            ], 400);
        }

        if ($coupon) {
          $discount = ($coupon->precent / 100) * $order->sub_total;
            $order->update([
            'coupon_id' => $coupon->id,
            'sub_total' => $order->sub_total,
            'discount' => $discount,
            'total' => $order->sub_total - $discount,
          ]);
          if($order){
            return response()->json([
                'success' => 1,
                'message' => __('application.coupon'),
            ], 200);
          }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
        }else {
          $order->update([
            'sub_total' => $order->sub_total,
            'total' => $order->sub_total,
          ]);
          if($order){
            return response()->json([
                'success' => 1,
                'message' => __('application.invacoupon'),
            ], 200);
          }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
          }
    }

    public function CancelOrder(CancelOrderRequest $request)
    {
          $order = Order::findOrFail($request->order_id);
          $order->update([
            'order_status_id' => 4
          ]);
          $restaurant = Restaurant::find($order->restaurant_id);
          $details = [
            'title_en' => 'Order Canceled',
            'body_en'  => 'User Canceled order',
            'title_ar' => 'تم الغاء الطلب',
            'body_ar'  => 'العميل قام بالغاء الطلب',
          ];
  
          $restaurant->notify(new CanceledStatus($details));

          if ($order) {
            return response()->json([
              'success' => 1,
              'message' => __('application.cancel')
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
    }

    public function RejectOrder(Request $request)
    {
      if ($request->order_id) {
        $order = Order::findOrFail($request->order_id);
        $order->update([
          'order_status_id' => 5
        ]);

        $user = User::find($order->user_id);
        $details = [
          'title_en' => 'Order Rejected',
          'body_en'  => 'Your order is rejected by restaurant',
          'title_ar' => 'طلبك مرفوض',
          'body_ar'  => 'طلبك مرفوض من قبل المطعم',
         ];

        $user->notify(new RejectedStatus($details));

        if ($order) {
          return response()->json([
            'success' => 1,
            'message' => __('application.reject')
          ], 200);
        }else {
          return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
          ], 400);
        }
      }elseif ($request->reservation_id) {
        $reservation = Reservation::findOrFail($request->reservation_id);
          $reservation->update([
            'order_status_id' => 5
          ]);
          $user = User::find($reservation->user_id);
          $details = [
            'title_en' => 'Order Rejected',
            'body_en'  => 'Your order is rejected by restaurant',
            'title_ar' => 'طلبك مرفوض',
            'body_ar'  => 'طلبك مرفوض من قبل المطعم',
           ];
  
          $user->notify(new RejectedStatus($details));
          if ($reservation) {
            return response()->json([
              'success' => 1,
              'message' => __('application.approv')
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
      }else {
        return response()->json([
            'success' => 0,
            'message' => __('application.errorhere')
        ], 400);
      }
         
    }

    public function AproveOrder(Request $request)
    {
      if ($request->order_id) {

        $order = Order::findOrFail($request->order_id);
          $order->update([
            'order_status_id' => 2
          ]);
          $user = User::find($order->user_id);
          $details = [
            'title_en' => 'Order Approved',
            'body_en'  => 'Your order is approved Hury up & place your order now',
            'title_ar' => 'طلبك مقبول',
            'body_ar'  => 'تمت الموافقة على طلبك ، سارع باتمام الدفع الآن ',
        ];
  
          $user->notify(new ApprovedStatus($details));

          if ($order) {
            return response()->json([
              'success' => 1,
              'message' => __('application.approv')
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
      }elseif($request->reservation_id){

        $reservation = Reservation::findOrFail($request->reservation_id);
        $reservation->update([
          'order_status_id' => 2
        ]);
        $user = User::find($reservation->user_id);
        $details = [
          'title_en' => 'Order Approved',
          'body_en'  => 'Your order is approved Hury up & place your order now',
          'title_ar' => 'طلبك مقبول',
          'body_ar'  => 'تمت الموافقة على طلبك ، سارع باتمام الدفع الآن ',
      ];

        $user->notify(new ApprovedStatus($details));

        if ($reservation) {
          return response()->json([
            'success' => 1,
            'message' => __('application.approv')
          ], 200);
        }else {
          return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
          ], 400);
        }
      }else{
        return response()->json([
            'success' => 0,
            'message' => __('application.errorhere')
        ], 400);
      }
         
    }

    public function ConfirmOrder(CancelOrderRequest $request)
    {
          $order = Order::findOrFail($request->order_id);
          $order->update([
            'order_status_id' => 3
          ]);
          if ($order) {
            return response()->json([
              'success' => 1,
              'message' => __('application.complete')
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
    }
    
    public function CompleteOrder(CancelOrderRequest $request)
    {
          $order = Order::findOrFail($request->order_id);
          $order->update([
            'order_status_id' => 6
          ]);
          if ($order) {
            return response()->json([
              'success' => 1,
              'message' => __('application.complete')
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
    }

    public function ActiveOrders()
    {
        $types = OrderType::get();
        if ($types) {
            return response()->json([
              'success' => 1,
              'types' => OrderTypeResource::collection($types),
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
    }
    
    public function HistoryOrders()
    {
      $types = OrderType::get();
      if ($types) {
        return response()->json([
          'success' => 1,
          'types' => OrderTypeResource::collection($types),
        ], 200);
        }else {
          return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
          ], 400);
        }
    }   
      
    public function ActiveOrdersRestaurant(Request $request)
    {
        $status = OrderStatus::whereIn('id',[1,2,3])->get();
        if ($status) {
            return response()->json([
              'success'  => 1,
              'statuses' => OrderStatusResource::collection($status),
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
    }

    public function HistoryOrdersRestaurant(Request $request)
    {
        $status = OrderStatus::whereIn('id',[4,5,6])->get();
        if ($status) {
            return response()->json([
              'success'  => 1,
              'statuses' => OrderStatusResource::collection($status),
            ], 200);
          }else {
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
          }
    }

}
    
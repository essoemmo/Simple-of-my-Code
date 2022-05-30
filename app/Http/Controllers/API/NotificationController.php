<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DeleteNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function userNotifications(Request $request)
    {
        auth('api')->user()->unreadNotifications->markAsRead();
        $notifications = auth('api')->user()->notifications()->latest()->get();

        if ($notifications) {
            return response()->json([
              'success'       => 1,
              'notifications' => NotificationResource::collection($notifications),
            ], 200);
          }else {
            return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
            ], 400);
          }
    }

     public function restNotifications(Request $request)
    {
        auth('restaurant-api')->user()->unreadNotifications->markAsRead();
        $notifications = auth('restaurant-api')->user()->notifications()->latest()->get();

        if ($notifications) {
            return response()->json([
              'success'       => 1,
              'notifications' => NotificationResource::collection($notifications),
            ], 200);
          }else {
            return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
            ], 400);
          }
    }

    public function DeleteNotification(DeleteNotificationRequest $request)
    {
      if ($request['notification_id']) {
       
        $notification = auth('api')->user()->notifications()->whereId($request['notification_id'])->delete();
      }else{
        $notification = auth('api')->user()->notifications()->delete();
      }

        if ($notification) {
            return response()->json([
              'success'  => 1,
              'message'  =>  __('application.deleted'),
            ], 200);
          }
    }

    public function DeleteResNotification(DeleteNotificationRequest $request)
    {
      if ($request['notification_id']) {
       
        $notification = auth('restaurant-api')->user()->notifications()->whereId($request['notification_id'])->delete();
      }else{
        $notification = auth('restaurant-api')->user()->notifications()->delete();
      }

        if ($notification) {
            return response()->json([
              'success'  => 1,
              'message'  =>  __('application.deleted'),
            ], 200);
          }
    }
}

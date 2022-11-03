<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\DeleteNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

  use ResponseTrait;

    public function userNotifications(Request $request)
    {
        auth('api')->user()->unreadNotifications->markAsRead();
        $notifications = auth('api')->user()->notifications()->latest()->get();
        return self::successResponse('' , NotificationResource::collection($notifications));
    }

    public function DeleteNotification(DeleteNotificationRequest $request)
    {
      if ($request['notification_id']) {
       
        $notification = auth('api')->user()->notifications()->whereId($request['notification_id'])->delete();
      }else{
        $notification = auth('api')->user()->notifications()->delete();
      }
      return self::successResponse(__('admin.deleted'));
    }
}

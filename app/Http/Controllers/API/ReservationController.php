<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\ApproveResrvRequest;
use App\Http\Requests\User\AcceptInvite as UserAcceptInvite;
use App\Http\Requests\User\AddInviteRequest;
use App\Http\Requests\User\AddReservationRequest;
use App\Http\Requests\User\CancelReservationRequest;
use App\Http\Requests\User\UpdateReservSet;
use App\Http\Requests\User\AcceptInvites;
use App\Http\Requests\User\InviteDetails;
use App\Http\Resources\InviteDetailsResource;
use App\Http\Resources\InvitionsResource;
use App\Models\Invite;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\AcceptInvite;
use App\Notifications\ApprovedStatus;
use App\Notifications\NewInvite;
use App\Notifications\RejectedStatus;
use Illuminate\Http\Request;
use Notification;

class ReservationController extends Controller
{
    public function AddReservation(AddReservationRequest $request)
    {
        $user = auth('api')->user();
        $user_reserv = $user->reservations()
        ->where('restaurant_id',$request->restaurant_id)
        ->where('date',$request->date)
        ->where('time',date("H:i", strtotime(convert2english($request->time))))
        ->count();

        if($user_reserv) { 
            return response()->json([
                'success' => 0,
                'message' => __('application.resrvbefor')
            ], 400);
        }

        $reserv = Reservation::create([
            'user_id'         => $user->id,
            'restaurant_id'   => $request->restaurant_id,
            'order_status_id' => 1,
            'sets'            => $request->sets,
            'note'            => $request->note,
            'date'            => $request->date,
            'type_place_id'   => $request->type_place_id,
            'time'            => date("H:i", strtotime(convert2english($request->time))),
        ]);

        if ($reserv) {
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

    public function UpdateReserv(UpdateReservSet $request)
    {
        $user = auth('api')->user();
        $user->reservations()->where('id',$request->reservation_id)->update(['sets',$request->sets]);
        if ($user) {
            return response()->json([
                'success' => 1,
                'message' => __('application.updated'),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

    public function CancelReserv(CancelReservationRequest $request)
    {
          $reserv = Reservation::findOrFail($request->reservation_id);
          $reserv->update([
            'order_status_id' => 4
          ]);
          if ($reserv) {
            return response()->json([
              'success' => 1,
              'message' => __('application.cancelres')
            ], 200);
          }else {
            return response()->json([
              'success' => 0,
              'message' => __('application.errorhere')
            ], 400);
          }
    }

    public function AddInvite(AddInviteRequest $request)
    {
        $user = User::where('phone',$request->phone)->first();
        $invite = Invite::create([
            'user_id'        => $user->id,
            'reservation_id' => $request->reservation_id,
        ]);

        $details = [
            'title_en' => 'New invitation',
            'body_en'  => 'You have new invitation, accept for make order !',
            'title_ar' => 'لديك دعوة جديدة',
            'body_ar'  => 'لديك دعوة جديدة ، اقبلها لتقديم طلبك! ',
        ];
  
        $user->notify(new NewInvite($details));

        if ($invite) {
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

    public function InvitesResrve(Request $request)
    {
        $reservation = Reservation::where('id',$request->reservation_id)->first();
        $invites = $reservation->invitions;
        if ($invites) {
            return response()->json([
                'success' => 1,
                'invites' => InvitionsResource::collection($invites),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }

    public function Invitions()
    {
        $user = auth('api')->user();
        $invites = $user->invitions;
        if ($invites) {
            return response()->json([
                'success' => 1,
                'invites' => InvitionsResource::collection($invites),
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => __('application.errorhere')
            ], 400);
        }
    }
    
    public function AcceptInvite(AcceptInvites $request)
    {
        $user = auth('api')->user();
        $invite = Invite::where('id',$request->invite_id)->first();
        if ($request->status == 1) {
            $invite->update([
                'user_id' => $user->id,
                'status'  => $request->status,
            ]);
        }else{
            $invite->delete();
            return response()->json([ 
            'success' => 1,
            'message' => __('application.added'),
           ], 400);
        }
        
        $userreserv = $invite->reservations->users->id;
        $userdata   = User::find($userreserv);
        
        $details = [
            'title_en' => 'Invitation accepted',
            'body_en'  => 'Your friend' .$user->name. 'accepted your invitation ',
            'title_ar' => 'دعوة تم قبولها',
            'body_ar'  => 'صديقك' .$user->name. 'قبل دعوتك ',
        ];
  
        $userdata->notify(new AcceptInvite($details));

        if ($invite) {
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

    public function myInviteDetails(InviteDetails $request)
    {
        $invite = Invite::where('id',$request->invite_id)->first();

        if ($invite) {
            return response()->json([
                'success' => 1,
                'invite' => new InviteDetailsResource($invite),
            ], 200);
        }

    }

    public function ApproveReservation(ApproveResrvRequest $request)
    {
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
    }

    public function RejectReservation(ApproveResrvRequest $request)
    {
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
    }

}

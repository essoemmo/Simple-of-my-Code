<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Requests\API\UpdateKidRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\RechargeResource;
use App\Http\Resources\ScanResource;
use App\Http\Resources\UserResource;
use App\Models\Recharge;
use App\Models\Scan;
use App\Models\User;
use App\Notifications\NfcNotification;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class KidController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $kids = auth('api')->user()->kids;
        return self::successResponse('' , UserResource::collection($kids));
    }

    public function show(User $kid)
    {
        return self::successResponse('' , UserResource::make($kid));
    }


    public function store(RegisterRequest $request)
    {
        $kidData = $request->safe()->except(['image']);
        $kidData['image']      = UploadImage($request->image,'kids');
        $kidData['password'] = bcrypt($request->password);
        $kidData['user_id'] = auth()->id();
        $kid = User::create($kidData);
        return self::successResponse(__('application.added') , UserResource::make($kid));
    }

    public function update(UpdateKidRequest $request , User $kid)
    {
        $kidData = $request->safe()->except(['image' , 'password']);
        if($request->image)
            $kidData['image']   = UploadImage($request->image,'kids');
        if($request->password)
            $kidData['password'] = bcrypt($request->password);

        $kid->update($kidData);
        return self::successResponse(__('application.updated') , UserResource::make($kid));
    }

    public function charge(Request $request , User $kid)
    {
        $parent = auth()->user();
        $amount = $request->validate([
            'amount' => "required|numeric|min:1|max:{$parent->balance}"
        ])['amount'];
        $parent->update([
            'balance' => $parent->balance-$amount
        ]);
        $kid->update([
            'balance' => $kid->balance+$amount
        ]);
        $parent->charges()->create([
            'kid_id'    =>$kid->id,
            'amount'    =>$amount,
        ]);
        return self::successResponse(__('application.added'));
    }

    public function chargeHistory(User $kid)
    {
        $recharges = Recharge::where('kid_id' , $kid->id)->get();
        return self::successResponse('' , RechargeResource::collection($recharges));
    }

    public function orders(User $kid)
    {
        $orders = $kid->kidOrders()->with('products')->get();
        return self::successResponse('' , OrderResource::collection($orders));
    }


    public function scans(User $kid)
    {
        $scans = $kid->kidScans;
        return self::successResponse('' , ScanResource::collection($scans));
    }

    public function scan(Request $request)
    {
        $scanData = $request->validate([
            'kid_id'=> 'required',
            'user_id' => 'nullable',
            'lat'   => 'required',
            'lang'  => 'required',
            'type'  => 'required'
        ]);

        Scan::create($scanData);
        $kid = User::find($scanData['kid_id']);
        $user = User::find($scanData['user_id']);

        $details = [
            'title_en' => 'New Scan for ' .$kid->name,
            'body_en'  => 'New Scan has been added',
            'title_ar' => 'تمت عمليه مسح ل' .$kid->name,
            'body_ar'  => 'تمت اضافة تحديد جديد',
          ];
  
        $user->notify(new NfcNotification($details));

        return self::successResponse('' , UserResource::make($kid));
    }
}

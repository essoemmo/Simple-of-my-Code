<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceLeaveResource;
use App\Models\Scan;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends BaseController
{
    use ResponseTrait;

    public function scan(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'lat'        => 'required|', //sell,leave,attendance,other
                'lng'        => 'required|',
                'type'        => 'required|',
                'kid_id'        => 'required|exists:users,id',
            ]);
            if ($validator->fails()) {
                return response(['success' => false, 'message' => $validator->errors()->first()], 422);
            }
            Scan::create(['lat' => $request->lat, 'lng' => $request->lng, 'kid_id' => $request->kid_id, 'user_id' => auth()->user()->id, 'type' => $request->type]);
            DB::commit();
            return $this->sendResponse('done', 'scan');
        } catch (\Exception $e) {
            return $e;
            DB::rollback();
            // something went wrong
        }
    }

    public function home(Request $request)
    {
        if($request->date){
            $data = Scan::where('user_id',auth()->id())->DateFilter($request->date)->get();
        }else{
            $data = Scan::where('user_id',auth()->id())->DateFilter(Carbon::now())->get();
        }
        $data = Scan::where('user_id',auth()->id())->inRandomOrder()->get();
        return self::successResponse('',AttendanceLeaveResource::collection($data));
    }

    public function attendance()
    {
        $data = Scan::where('user_id',auth()->id())->where('type', 'attendance')->get();
        return self::successResponse('',AttendanceLeaveResource::collection($data));
    }

    public function leave()
    {
        $data = Scan::where('user_id',auth()->id())->where('type', 'leave')->get();
        return self::successResponse('',AttendanceLeaveResource::collection($data));
    }
    public function attendanceLeave()
    {
        $data['attendance'] = AttendanceLeaveResource::collection(Scan::where('type', 'attendance')->get());
        $data['leave'] = AttendanceLeaveResource::collection(Scan::where('type', 'leave')->get());
        return self::successResponse('',$data);
    }
}

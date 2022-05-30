<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRate;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function addRate(StoreRate $request)
    {
            $rate =  Rate::create([
                'user_id'      => auth('api')->user()->id,
                'restaurant_id'  => $request->restaurant_id,
                'stars'        => $request->input('stars'), 
                'review'       => $request->input('review'), 
            ]);

            if($rate){
                return response()->json([
                    'success' => 1,
                    'message'=>__('admin.rate_succes'),
                ],200);
            }
    
    }
}

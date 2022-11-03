<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DropDownResource;
use App\Models\City;
use App\Models\Langauage;
use App\Models\National;
use App\Models\Relation;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AuthDropdownController extends Controller
{
    use ResponseTrait;

    public function cities()
    {
        $cities = City::all();
        return self::successResponse('',DropDownResource::collection($cities));
    }

    public function langs()
    {
        $langs = Langauage::all();
        return self::successResponse('',DropDownResource::collection($langs));
    }

    public function nationals()
    {
        $nationals = National::all();
        return self::successResponse('',DropDownResource::collection($nationals));
    }

    public function relations()
    {
        $relation = Relation::all();
        return self::successResponse('',DropDownResource::collection($relation));
    }
}

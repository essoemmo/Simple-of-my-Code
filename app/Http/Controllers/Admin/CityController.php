<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCity;
use App\Http\Requests\Admin\UpdateCity;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('cities',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(CityDataTable $cities)
    {
        return $cities->render('admin.cities.index');
    }

    public function store(StoreCity $request)
    {
        $city = City::create($request->validated());
        return response()->json(['status'=>'success','data'=>$city]);
    }

    public function CityStatus(Request $request)
    {
        $city = City::find($request->city_id);
        $city->active = $request->active;
        $city->save();
        return response()->json(['status' => 'success', 'data' => $city]);
    }

    public function update(UpdateCity $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->validated());

        return response()->json(['status'=>'success','data'=>$city]);
    }

    public function destroy($id)
    {
        $city = City::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RestaurantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRestaurant;
use App\Http\Requests\Admin\UpdateRestaurant;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RestaurantsController extends BaseAdminController
{
    
    public function __construct()
    {
        $this->permissionsAdmin('restaurants',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(RestaurantDataTable $restaurants)
    {
        return $restaurants->render('admin.restaurants.index');
    }

    public function store(StoreRestaurant $request)
    {
        $request->merge(['phone' => '+966'.$request->phone]);
        $restaurant = Restaurant::create($request->all());
        if ($restaurant) {
            $restaurant->update([
                'image'    => UploadImage($request->image,'restaurants'),
                'cover'    => UploadImage($request->cover,'restaurants'),
                'code'     => mt_rand(1000, 9999),
                'password' => Hash::make($request->password)
            ]);
        }
        QrCode::size(450)->format('png')->generate($restaurant->id, 'images/'.$restaurant->id.'.png');
        return response()->json(['status' => 'success', 'data' => $restaurant]);
    }

    public function RestaurantStatus(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $restaurant->active = $request->active;
        $restaurant->save();
        return response()->json(['status' => 'success', 'data' => $restaurant]);
    }

    public function update(UpdateRestaurant $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($request->validated());
        if ($request->image) {
            $restaurant->update(['image' => UploadImage($request->image,'restaurants')]);
        }
        if ($request->cover) {
            $restaurant->update(['cover' => UploadImage($request->cover,'restaurants')]);
        }
        return response()->json(['status' => 'success', 'data' => $restaurant]);
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        if ($restaurant->image) {
            unlink($restaurant->image);
        }
        if ($restaurant->cover) {
            unlink($restaurant->cover);
        }
        $restaurant->delete();
        return response()->json(['status' => 'success']);
    }

}

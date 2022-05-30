<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\UpdateProfile;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::find(restId());
        return view('restaurant.settings.index', compact('restaurant'));
    }

    public function update(UpdateProfile $request)
    {
        $restaurant = Restaurant::find(restId());
        $restaurant->update($request->safe()->except(['image','password','cover']));
        if($request->password){
            $restaurant->update(['password'  => Hash::make($request->password)]);
        }
        if ($request->image) {
            $restaurant->update(['image' => UploadImage($request->image,'restaurants')]);
        }
        if ($request->cover) {
            $restaurant->update(['cover' => UploadImage($request->cover,'restaurants')]);
        }
        return response()->json(['status' => 'success', 'data' => $restaurant]);
    }

    public function fileDownload()
    {
        $restaurant = Restaurant::find(restId())->first();
        return response()->download(public_path('/images/'.$restaurant->id.'.png'));
    }

}

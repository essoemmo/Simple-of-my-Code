<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StorePhoto;
use App\Models\Photo;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index()
    {
        $restaurant = auth('restaurant')->user();
        $photos = $restaurant->photos;
        return view('restaurant.photos.index' , compact('photos'));
    }

    public function store(StorePhoto $request)
    {
        $restaurant = auth('restaurant')->user();
        $photo = $restaurant->photos()->create([
            'image' => UploadImage($request->image,'photos'),
        ]);
        return response()->json(['status' => 'success', 'data' => $photo]);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);
        unlink($photo->image);
        $photo->delete();
        return response()->json(['status' => 'success']);
    }

}

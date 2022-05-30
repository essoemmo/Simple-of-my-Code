<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAmenity;
use App\Http\Requests\Admin\UpdateAmenity;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('amenities',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(AmenityDataTable $amenities)
    {
        return $amenities->render('admin.amenities.index');
    }

    public function store(StoreAmenity $request)
    {
        $amenity = Amenity::create($request->validated());
        if ($amenity) {
            $amenity->update([
                'image' => UploadImage($request->image,'amenity'),
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $amenity]);
    }

    public function AmenityStatus(Request $request)
    {
        $amenity = Amenity::find($request->amenity_id);
        $amenity->active = $request->active;
        $amenity->save();

        return response()->json(['status' => 'success', 'data' => $amenity]);
    }

    public function update(UpdateAmenity $request, $id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->update($request->validated());
        if ($request->image) {
            $amenity->update([
                'image' => UploadImage($request->image,'amenity'),
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $amenity]);
    }

    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        unlink($amenity->image);
        $amenity->delete();
        return response()->json(['status' => 'success']);
    }
}

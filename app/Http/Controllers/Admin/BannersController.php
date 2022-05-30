<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBanner;
use App\Http\Requests\Admin\updateBanner;
use App\Models\Banner;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class BannersController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('banners',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(BannerDataTable $banners)
    {
        $restaurants = Restaurant::get();
        return $banners->render('admin.banners.index', compact('restaurants'));
    }

    public function store(StoreBanner $request)
    {
        $banner =  Banner::create($request->validated());
        if ($banner) {
            $banner->update(['image' => UploadImage($request->image,'banners')]);
        }
        return response()->json(['status' => 'success', 'data' => $banner]);
    }

    public function BannerStatus(Request $request)
    {
        $banner = Banner::find($request->banner_id);
        $banner->active = $request->active;
        $banner->save();
        return response()->json(['status' => 'success', 'data' => $banner]);
    }

    public function update(updateBanner $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update($request->validated());
        if ($request->image) {
            $banner->update(['image' => UploadImage($request->image,'banners'),]);
        }
        return response()->json(['status' => 'success', 'data' => $banner]);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        unlink($banner->image);
        $banner->delete();
        return response()->json(['status' => 'success']);
    }
}

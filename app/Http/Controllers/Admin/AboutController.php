<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAbout;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('aboutus',$read = true, $create = false, $update = true, $delete = false);
    }
    
    public function index()
    {
        $about = AboutUs::where('id', 1)->first();
        return view('admin.aboutus.index', compact('about'));
    }

    public function update(UpdateAbout $request)
    {
        $about = AboutUs::where('id', 1)->first();
        $about->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $about]);
    }

}

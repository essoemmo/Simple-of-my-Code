<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePrivecy;
use App\Models\Privecy;
use Illuminate\Http\Request;

class PrivecyController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('privecy',$read = true, $create = false, $update = true, $delete = false);
    }

    public function index()
    {
        $privecy = Privecy::where('id', 1)->first();
        return view('admin.privecy.index', compact('privecy'));
    }

    function update(UpdatePrivecy $request)
    {
        $privecy = Privecy::where('id', 1)->first();
        $privecy->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $privecy]);
    }
}

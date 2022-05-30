<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUsage;
use App\Models\Usage;
use Illuminate\Http\Request;

class UsageController extends BaseAdminController
{
    public function __construct()
    {
        $this->permissionsAdmin('usages',$read = true, $create = false, $update = true, $delete = false);
    }

    function index()
    {
        $usage = Usage::where('id', 1)->first();
        return view('admin.usages.index', compact('usage'));
    }

    function update(UpdateUsage $request)
    {
        $usage = Usage::where('id', 1)->first();
        $usage->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $usage]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NationalDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNational;
use App\Http\Requests\Admin\UpdateNational;
use App\Models\National;
use Illuminate\Http\Request;

class NationalsController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('languages',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(NationalDataTable $nationals)
    {
        return $nationals->render('admin.nationals.index');
    }

    public function store(StoreNational $request)
    {
        $national = National::create($request->validated());
        return response()->json(['status'=>'success','data'=>$national]);
    }

    public function nationalStatus(Request $request)
    {
        $national = National::find($request->national_id);
        $national->active = $request->active;
        $national->save();
        return response()->json(['status' => 'success', 'data' => $national]);
    }

    public function update(UpdateNational $request, $id)
    {
        $national = National::findOrFail($id);
        $national->update($request->validated());

        return response()->json(['status'=>'success','data'=>$national]);
    }

    public function destroy($id)
    {
        $national = National::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }
}

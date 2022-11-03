<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RelationsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRelation;
use App\Http\Requests\Admin\UpdateRelation;
use App\Models\Relation;
use Illuminate\Http\Request;

class RelationsController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('relations',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(RelationsDataTable $relations)
    {
        return $relations->render('admin.relations.index');
    }

    public function store(StoreRelation $request)
    {
        $relation = Relation::create($request->validated());
        return response()->json(['status'=>'success','data'=>$relation]);
    }

    public function relationStatus(Request $request)
    {
        $relation = Relation::find($request->relation_id);
        $relation->active = $request->active;
        $relation->save();
        return response()->json(['status' => 'success', 'data' => $relation]);
    }

    public function update(UpdateRelation $request, $id)
    {
        $relation = Relation::findOrFail($id);
        $relation->update($request->validated());

        return response()->json(['status'=>'success','data'=>$relation]);
    }

    public function destroy($id)
    {
        $relation = Relation::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }

}

<?php

namespace App\Http\Controllers\Restaurant;

use App\DataTables\TypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreType;
use App\Http\Requests\Restaurant\UpdateType;
use App\Models\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function store(StoreType $request)
    {
        $type = Type::create($request->validated());
        return response()->json(['status' => 'success', 'data' => $type]);
    }

    public function TypeStatus(Request $request)
    {
        $type = Type::find($request->type_id)->update(['active' => $request->active]);
        return response()->json(['status' => 'success', 'data' => $type]);
    }

    public function update(UpdateType $request, $id)
    {
        $type = Type::find($id)->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $type]);
    }

    public function destroy($id)
    {
        $type = Type::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }
}

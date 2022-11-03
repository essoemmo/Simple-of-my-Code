<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LangauageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLang;
use App\Http\Requests\Admin\UpdateLang;
use App\Models\Langauage;
use Illuminate\Http\Request;

class LanguagesController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('languages',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(LangauageDataTable $languages)
    {
        return $languages->render('admin.languages.index');
    }

    public function store(StoreLang $request)
    {
        $language = Langauage::create($request->validated());
        return response()->json(['status'=>'success','data'=>$language]);
    }

    public function languageStatus(Request $request)
    {
        $language = Langauage::find($request->language_id);
        $language->active = $request->active;
        $language->save();
        return response()->json(['status' => 'success', 'data' => $language]);
    }

    public function update(UpdateLang $request, $id)
    {
        $language = Langauage::findOrFail($id);
        $language->update($request->validated());

        return response()->json(['status'=>'success','data'=>$language]);
    }

    public function destroy($id)
    {
        $language = Langauage::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateTerm as AdminUpdateTerm;
use App\Http\Requests\Admin\UpdateTerm;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends BaseAdminController
{

    public function __construct()
    {
        $this->permissionsAdmin('terms',$read = true, $create = false, $update = true, $delete = false);
    }

    function index()
    {
        $term = Term::where('id', 1)->first();
        return view('admin.terms.index', compact('term'));
    }

    function update(UpdateTerm $request)
    {
        $term = Term::where('id', 1)->first();
        $term->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $term]);
    }
}

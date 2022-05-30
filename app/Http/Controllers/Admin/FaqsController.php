<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FaqDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaq;
use App\Http\Requests\Admin\UpdateFaq;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends BaseAdminController
{
    public function __construct()
    {
      $this->permissionsAdmin('faqs',$read = true, $create = true, $update = true, $delete = true);
    }

    public function index(FaqDataTable $faqs)
    {
        return $faqs->render('admin.faqs.index');
    }

    public function store(StoreFaq $request)
    {
        $faq = Faq::create($request->validated());
        return response()->json(['status' => 'success', 'data' => $faq]);
    }

    public function update(UpdateFaq $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->validated());
        return response()->json(['status' => 'success', 'data' => $faq]);
    }

    public function destroy($id)
    {
        $faq = Faq::whereId($id)->delete();
        return response()->json(['status' => 'success']);
    }

}
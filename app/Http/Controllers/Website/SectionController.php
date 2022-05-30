<?php

namespace App\Http\Controllers\Website;

use App\DataTables\SectionDataTable;
use App\DataTables\SubSectionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSection;
use App\Http\Requests\Admin\UpdateSection;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    
    public function index(SectionDataTable $sections)
    {
        return $sections->render('admin.sections.index');
    }

    public function allSubSection(SubSectionDataTable $subsections, $id)
    {
        $section = Section::find($id);
        return $subsections->with('id', $id)->render('admin.subsections.index', compact('section'));
    }

    public function store(StoreSection $request)
    {
        $section = Section::create($request->validated());
        if ($section) {
            $section->update([
                'image' => UploadImage($request->image,'sections'),
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $section]);
    }

    public function update(UpdateSection $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->update($request->validated());
        if ($request->image) {
            $section->update([
                'image' => UploadImage($request->image,'sections'),
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $section]);
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        unlink($section->image);
        $section->delete();
        return response()->json(['status' => 'success']);
    }

}

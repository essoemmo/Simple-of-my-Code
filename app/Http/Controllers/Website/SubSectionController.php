<?php

namespace App\Http\Controllers\Website;

use App\DataTables\SubSectionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubSection;
use App\Http\Requests\Admin\UpdateSubSection;
use App\Models\Section;
use App\Models\SubSection;
use Illuminate\Http\Request;

class SubSectionController extends Controller
{
    public function store(StoreSubSection $request)
    {
        $subsection = SubSection::create($request->validated());
        if ($subsection) {
            $subsection->update([
                'image' => UploadImage($request->image,'subsections'),
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $subsection]);
    }

    public function update(UpdateSubSection $request, $id)
    {
        $subsection = SubSection::findOrFail($id);
        $subsection->update($request->validated());
        if ($request->image) {
            $subsection->update([
                'image' => UploadImage($request->image,'subsections'),
            ]);
        }
        return response()->json(['status' => 'success', 'data' => $subsection]);
    }

    public function destroy($id)
    {
        $subsection = SubSection::findOrFail($id);
        unlink($subsection->image);
        $subsection->delete();
        return response()->json(['status' => 'success']);
    }
}

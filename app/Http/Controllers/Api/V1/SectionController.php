<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\ActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Courses\SectionResource;
use App\Models\Courses\Section;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use ResponseTrait;

    public function allSections(Request $request, Section $section)
    {
        $sections = Section::whereParentId(null)->filter($request, (array)$section->filterableColumns)->where('status', ActiveEnum::active->value)->get();

        return self::successResponse(data: SectionResource::collection($sections));
    }


    public function section(Section $section)
    {
        return self::successResponse(data: SectionResource::make($section));
    }

}

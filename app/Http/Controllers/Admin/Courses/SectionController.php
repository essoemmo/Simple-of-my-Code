<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreSectionRequest;
use App\Http\Requests\Courses\UpdateSectionRequest;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Courses\mainSectionResource;
use App\Http\Resources\Courses\SectionResource;
use App\Http\Resources\Courses\SubSectionResource;
use App\Models\Courses\Section;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use ResponseTrait;

    //TODO: list of MainSections and it's SubSections

    /**
     * @param Request $request
     * @param Section $section
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Section $section, PageRequest $pageRequest)
    {
        $sections = Section::whereParentId(null)->filter($request, (array)$section->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: SectionResource::collection($sections)->response()->getData(true));
    }

    public function mainSections(Request $request, Section $section)
    {
        $sections = Section::whereParentId(null)->filter($request, (array)$section->filterableColumns)->get();

        return self::successResponse(data: mainSectionResource::collection($sections));
    }

    public function subSectionsList(Section $section)
    {
        $sections = Section::whereParentId($section->id)->get();

        return self::successResponse(data: SubSectionResource::collection($sections));
    }

// TODO: list of SubSections for specific MainSection

    /**
     * @param Request $request
     * @param Section $section
     * @return JsonResponse
     */
    public function subSections(Request $request, Section $section)
    {
        $sections = $section->sections()->filter($request, (array)$section->filterableColumns)->paginate(10);

        return self::successResponsePaginate(data: SectionResource::collection($sections)->response()->getData(true));
    }

// TODO: create new section

    /**
     * @param StoreSectionRequest $request
     * @return JsonResponse
     */
    public function store(StoreSectionRequest $request): JsonResponse
    {
        $section = Section::create($request->validated());

        if ($request->attachments) {
            $section->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.added'), data: SectionResource::make($section));
    }

//TODO: show specific section

    /**
     * @param Section $section
     * @return JsonResponse
     */
    public function show(Section $section)
    {
        return self::successResponse(data: SectionResource::make($section));
    }

// TODO: update specific section

    /**
     * @param UpdateSectionRequest $request
     * @param Section $section
     * @return JsonResponse
     */
    public function update(UpdateSectionRequest $request, Section $section): JsonResponse
    {
        $section->update($request->validated());

        if ($request->attachments) {
            $section->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'), data: SectionResource::make($section));
    }

    // TODO: delete specific section

    /**
     * @param Section $section
     * @return JsonResponse
     */
    public function destroy(Section $section)
    {
        if ($section->courses()->count() > 0) {
            return self::failResponse(400, message: __('application.cannot_delete'));
        }
        $section->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

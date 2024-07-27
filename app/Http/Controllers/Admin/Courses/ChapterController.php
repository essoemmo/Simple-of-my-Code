<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreChapterRequest;
use App\Http\Requests\Courses\UpdateChapterRequest;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Courses\ChapterResource;
use App\Models\Courses\Chapter;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    use ResponseTrait;

    //TODO: list of chapters

    /**
     * @param Request $request
     * @param Chapter $chapter
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Chapter $chapter, PageRequest $pageRequest)
    {
        $chapters = Chapter::filter($request, (array)$chapter->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: ChapterResource::collection($chapters)->response()->getData(true));
    }

    //TODO: create new chapter

    /**
     * @param StoreChapterRequest $request
     * @return JsonResponse
     */
    public function store(StoreChapterRequest $request): JsonResponse
    {
        $chapter = Chapter::create($request->validated());

        return self::successResponse(message: __('application.added'), data: ChapterResource::make($chapter));
    }

    //TODO: show chapter
    public function show(Chapter $chapter)
    {
        return self::successResponse(data: ChapterResource::make($chapter));
    }

    //TODO: update chapter

    /**
     * @param UpdateChapterRequest $request
     * @param Chapter $chapter
     * @return JsonResponse
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter): JsonResponse
    {
        $chapter->update($request->validated());

        return self::successResponse(message: __('application.updated'), data: ChapterResource::make($chapter));
    }

    //TODO: delete chapter

    /**
     * @param Chapter $chapter
     * @return JsonResponse
     */
    public function destroy(Chapter $chapter)
    {
        if ($chapter->lessons()->count() > 0) {
            return self::failResponse(400, message: __('application.chapter_has_lessons'));
        }
        $chapter->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

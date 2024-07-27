<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreChapterRequest;
use App\Http\Requests\Courses\UpdateChapterRequest;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Courses\ChapterResource;
use App\Models\Courses\Chapter;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ChapterController extends Controller
{
    use ResponseTrait;

    public function index(PageRequest $pageRequest)
    {
        $chapters = Chapter::paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: ChapterResource::make($chapters)->response()->getData(true));
    }

    public function store(StoreChapterRequest $request): JsonResponse
    {
        Chapter::create($request->validated());

        return self::successResponse(message: __('application.added'));
    }

    public function show(Chapter $chapter)
    {
        return self::successResponse(data: ChapterResource::make($chapter));
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter): JsonResponse
    {
        $chapter->update($request->validated());

        return self::successResponse(message: __('application.updated'));
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreLessonRequest;
use App\Http\Requests\Courses\UpdateLessonRequest;
use App\Http\Resources\Courses\LessonResource;
use App\Models\Courses\Chapter;
use App\Models\Courses\Course;
use App\Models\Courses\CourseChapterLesson;
use App\Models\Courses\Lesson;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $lessons = Lesson::paginate(10);

        return self::successResponsePaginate(data: LessonResource::collection($lessons)->response()->getData(true));
    }

    public function store(StoreLessonRequest $request): JsonResponse
    {
        $lesson = Lesson::create($request->safe()->except('attachments'));

        if ($request->attachments) {
            $lesson->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.added'),data: LessonResource::make($lesson));
    }

    public function lessonsByChapterId(Request $request, Chapter $chapter)
    {
        $lessons = lesson::whereChapter_id($chapter->id)->get();
        return self::successResponse(data: LessonResource::collection($lessons));
    }

    public function lessonsByCourseId(Request $request, Course $course)
    {
        $lessons = lesson::whereCourse_id($course->id)->get();

        return self::successResponse(data: LessonResource::collection($lessons));
    }


    public function show(Lesson $lesson)
    {
        return self::successResponse(data: LessonResource::make($lesson));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson): JsonResponse
    {
        DB::beginTransaction();
        try {
            $lesson->update($request->safe()->except('attachments'));

            if ($request->has('attachments')) {
                $lesson->assignAttachment($request->attachments);
            }

            $lessonCourseData = $request->safe()->only(['chapter_id', 'course_id']);
            // Remove old pivot entry
            $courseLesson = CourseChapterLesson::whereLesson_id($lesson->id)->first();
            $lessonCourseData['lesson_id'] = $lesson->id;
            $courseLesson->update($lessonCourseData);

            DB::commit();

            // Return a successful response
            return self::successResponse(message: __('application.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update lesson', ['error' => $e->getMessage()]);

            return self::failResponse(500, message: __('application.error'));
        }
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->chapter()->delete();
        $lesson->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

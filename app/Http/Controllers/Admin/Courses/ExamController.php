<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\StoreExamRequest;
use App\Http\Requests\Exams\UpdateExamRequest;
use App\Http\Resources\Exams\ExamResource;
use App\Models\Courses\Chapter;
use App\Models\Courses\Course;
use App\Models\Courses\CourseChapter;
use App\Models\Exams\Exam;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    use ResponseTrait;

//TODO: list of exams with filters and pagination

    /**
     * @param Request $request
     * @param Exam $exam
     * @return JsonResponse
     */
    public function index(Request $request, Exam $exam)
    {
        $exams = Exam::filter($request, (array)$exam->filterableColumns)->paginate(10);
        return self::successResponsePaginate(data: ExamResource::collection($exams)->response()->getData(true));

    }

//TODO: show single exam

    /**
     * @param Exam $exam
     * @return JsonResponse
     */
    public function show(exam $exam)
    {
        return self::successResponse(data: ExamResource::make($exam));
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return JsonResponse
     */
    public function examsByCourse(Request $request, Course $course)
    {
        //get chapters in this course
        $chapters = CourseChapter::whereCourse_id($course->id)->pluck('chapter_id')->toArray();
        $exams = Exam::whereIn('chapter_id', $chapters)->get();
        return self::successResponse(data: ExamResource::collection($exams));

    }

    /**
     * @param Request $request
     * @param Chapter $chapter
     * @return JsonResponse
     */
    public function examsByChapter(Request $request, Chapter $chapter)
    {
        $exams = Exam::whereChapter_id($chapter->id)->get();
        return self::successResponse(data: ExamResource::collection($exams));
    }
//TODO: create new exam

    /**
     * @param StoreExamRequest $request
     * @return JsonResponse
     */
    public function store(StoreExamRequest $request): JsonResponse
    {
        $exam = Exam::create($request->validated());
        return self::successResponse(message: __('application.added'), data: ExamResource::make($exam));
    }
//TODO: update exam

    /**
     * @param UpdateExamRequest $request
     * @param Exam $exam
     * @return JsonResponse
     */
    public function update(UpdateExamRequest $request, Exam $exam): JsonResponse
    {
        $exam->update($request->validated());
        return self::successResponse(message: __('application.updated'));
    }
//TODO: delete exam

    /**
     * @param Exam $exam
     * @return JsonResponse
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return self::successResponse(message: __('application.deleted'));
    }


}

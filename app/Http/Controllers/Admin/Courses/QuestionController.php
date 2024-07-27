<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\StoreQuestionRequest;
use App\Http\Requests\Exams\UpdateQuestionRequest;
use App\Http\Resources\Exams\QuestionResource;
use App\Models\Exams\Exam;
use App\Models\Exams\Question;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use ResponseTrait;
    // TODO: List of questions with pagination

    /**
     * @return JsonResponse
     */

    public function index()
    {
        $questions = Question::paginate(10);

        return self::successResponsePaginate(data: QuestionResource::collection($questions)->response()->getData(true));
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return JsonResponse
     */
    public function questionByExamId(Request $request, Exam $exam)
    {
        $questions = Question::whereExam_id($exam->id)->get();
        return self::successResponse(data: QuestionResource::collection($questions));

    }

    /**
     * @param StoreQuestionRequest $request
     * @return JsonResponse
     */
    public function store(StoreQuestionRequest $request): JsonResponse
    {
        $question = Question::create($request->validated());

        return self::successResponse(message: __('application.added'),data: QuestionResource::make($question));
    }

    /**
     * @param Question $question
     * @return JsonResponse
     */
    public function show(Question $question)
    {
        return self::successResponse(data: QuestionResource::make($question));
    }

    /**
     * @param UpdateQuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     */
    public function update(UpdateQuestionRequest $request, Question $question): JsonResponse
    {
        $question->update($request->validated());

        return self::successResponse(message: __('application.updated'));
    }

    /**
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

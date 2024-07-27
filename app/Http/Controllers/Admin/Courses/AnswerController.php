<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\StoreAnswerRequest;
use App\Http\Requests\Exams\UpdateAnswerRequest;
use App\Http\Resources\Exams\AnswerResource;
use App\Models\Exams\Answer;
use App\Models\Exams\Question;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    use ResponseTrait;

// TODO: List of answers with pagination

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $answers = Answer::paginate(10);

        return self::successResponsePaginate(data: AnswerResource::collection($answers)->response()->getData(true));
    }

// TODO: List of answers with pagination
    /**
     * @param Request $request
     * @param Question $question
     * @return JsonResponse
     */
    public function answersByQuestion(Request $request, Question $question)
    {
        $answers = Answer::whereQuestion_id($question->id)->get();
        return self::successResponse(data: AnswerResource::collection($answers));
    }

// TODO: store new answer
    /**
     * @param StoreAnswerRequest $request
     * @return JsonResponse
     */
    public function store(StoreAnswerRequest $request): JsonResponse
    {
        Answer::create($request->validated());

        return self::successResponse(message: __('application.added'));
    }
// TODO: show answer
    /**
     * @param Answer $answer
     * @return JsonResponse
     */
    public function show(Answer $answer)
    {
        return self::successResponse(data: AnswerResource::make($answer));
    }
// TODO: update answer
    /**
     * @param UpdateAnswerRequest $request
     * @param Answer $answer
     * @return JsonResponse
     */
    public function update(UpdateAnswerRequest $request, Answer $answer): JsonResponse
    {
        $answer->update($request->validated());

        return self::successResponse(message: __('application.updated'));
    }
// TODO: delete answer
    /**
     * @param Answer $answer
     * @return JsonResponse
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

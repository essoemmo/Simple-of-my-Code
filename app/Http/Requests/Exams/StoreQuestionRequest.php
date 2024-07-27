<?php

namespace App\Http\Requests\Exams;

use App\Http\Requests\ApiFormRequest;

class StoreQuestionRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'exam_id' => ['required', 'integer', 'exists:exams,id'],
            'question_type' => ['required', 'integer'],
            'question_text' => ['required', 'string'],
            'answer_text' => ['required', 'string'],
            'explanation' => ['required', 'string'],
            'correct_order' => ['required', 'integer'],
        ];
    }
}

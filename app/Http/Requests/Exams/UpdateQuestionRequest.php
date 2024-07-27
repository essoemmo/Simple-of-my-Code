<?php

namespace App\Http\Requests\Exams;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateQuestionRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [

            'exam_id' => ['integer',Rule::unique('questions')->ignore($this->question->id)],
            'question_type' => ['integer'],
            'question_text' => ['string'],
            'degree' => ['integer'],
        ];
    }
}

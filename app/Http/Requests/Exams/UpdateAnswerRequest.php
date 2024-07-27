<?php

namespace App\Http\Requests\Exams;

use App\Http\Requests\ApiFormRequest;

class UpdateAnswerRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'question_id' => ['integer', 'exists:questions,id'],
            'answer_text' => ['string'],
            'explanation' => ['string'],
            'is_correct' =>  ['boolean'],
        ];
    }
}

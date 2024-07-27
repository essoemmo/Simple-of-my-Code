<?php

namespace App\Http\Requests\Exams;

use App\Http\Requests\ApiFormRequest;

class StoreAnswerRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'answer_text' => ['required', 'string'],
            'explanation' => ['string'],
            'is_correct' => ['boolean'],
        ];
    }
}

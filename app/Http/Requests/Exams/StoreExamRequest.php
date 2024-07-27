<?php

namespace App\Http\Requests\Exams;

use App\Http\Requests\ApiFormRequest;

class StoreExamRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'chapter_id' => ['nullable', 'integer', 'exists:chapters,id'],
            'instructions' => ['required','string'],
            'min_passing_grade' => ['required','numeric'],
            'random_questions' => ['nullable','integer'],
            'num_random_questions' => ['required','integer'],
            'status' => ['required','boolean'],
        ];
    }
}

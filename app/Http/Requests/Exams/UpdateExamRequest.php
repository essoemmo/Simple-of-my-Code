<?php

namespace App\Http\Requests\Exams;

use App\Http\Requests\ApiFormRequest;

class UpdateExamRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => ['nullable', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'chapter_id' => ['nullable', 'integer', 'exists:chapters,id'],
            'instructions' => ['nullable','string'],
            'min_passing_grade' => ['nullable','numeric'],
            'random_questions' => ['nullable','boolean'],
            'num_random_questions' => ['nullable','integer'],
            'status' => ['nullable','boolean'],
        ];
    }
}

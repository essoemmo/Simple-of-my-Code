<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFAQRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'question_ar' => ['nullable'],
            'answer_ar' => ['nullable'],
            'question_en' => ['nullable'],
            'answer_en' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

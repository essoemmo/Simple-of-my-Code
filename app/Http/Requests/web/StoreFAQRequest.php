<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreFAQRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'question_ar' => ['required'],
            'answer_ar' => ['required'],
            'question_en' => ['required'],
            'answer_en' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

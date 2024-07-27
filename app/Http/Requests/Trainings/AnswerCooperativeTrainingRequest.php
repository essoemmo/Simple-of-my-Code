<?php

namespace App\Http\Requests\Trainings;

use Illuminate\Foundation\Http\FormRequest;

class AnswerCooperativeTrainingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'integer', 'in:0,1'],
            'start_date' => [
                'nullable',
                'date',
                'before:end_date',
                'date_format:Y-m-d',
                'required_if:status,1',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after:start_date',
                'date_format:Y-m-d',
                'required_if:status,1',
            ],
            'refuse_reason' => ['nullable', 'string', 'required_if:status,0'],
        ];
    }
}

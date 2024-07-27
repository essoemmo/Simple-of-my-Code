<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;

class UpdateMandatoryScheduleRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'course_id' => ['nullable', 'integer', 'exists:courses,id'],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'location' => ['nullable', 'string', 'max:255'],
            'percentage' => ['nullable', 'integer'],

            'lectures' => ['nullable', 'array', 'min:1', 'bail'],
            'lectures.*.date' => ['nullable', 'date_format:Y-m-d'],
            'lectures.*.time' => ['nullable', 'date_format:H:i:s'],
        ];
    }
}

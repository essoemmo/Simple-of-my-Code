<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;

class StoreMandatoryScheduleRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'location' => ['required', 'string', 'max:255'],
            'percentage' => ['nullable', 'integer'],

            'lectures' => ['required', 'array', 'min:1', 'bail'],
            'lectures.*.date' => ['required', 'date_format:Y-m-d'],
            'lectures.*.time' => ['required', 'date_format:H:i:s'],
        ];
    }
}

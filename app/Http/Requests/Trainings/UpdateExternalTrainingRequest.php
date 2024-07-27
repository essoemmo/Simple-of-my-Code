<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;

class UpdateExternalTrainingRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'course_name' => ['required', 'string', 'max:255'],
            'training_type' => ['required', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'status' => ['nullable', 'integer'],
            'time' => ['nullable', 'date_format:H:i'],
            'days' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'training_benefit' => ['nullable', 'string'],
            'skills_training' => ['nullable', 'string'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

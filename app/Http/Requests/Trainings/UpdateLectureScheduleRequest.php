<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;

class UpdateLectureScheduleRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['nullable','string','max:255'],
        ];
    }
}

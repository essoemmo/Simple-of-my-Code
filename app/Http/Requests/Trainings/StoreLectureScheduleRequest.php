<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;

class StoreLectureScheduleRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
        ];
    }
}

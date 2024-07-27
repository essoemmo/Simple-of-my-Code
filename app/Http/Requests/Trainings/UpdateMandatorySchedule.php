<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMandatorySchedule extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'mandatory_lecture_id'=>'nullable|integer|exists:mandatory_lectures,id',
            'lecture_schedule_id'=>'nullable|integer|exists:lecture_schedules,id',
            'time_from'=>['required', 'date', 'date_format:H:i:s'],
            'time_to'=>['required', 'date',  'date_format:H:i:s']
        ];
    }
}

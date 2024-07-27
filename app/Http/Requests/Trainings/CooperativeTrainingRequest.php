<?php

namespace App\Http\Requests\Trainings;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class CooperativeTrainingRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

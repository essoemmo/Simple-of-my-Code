<?php

namespace App\Http\Requests\Departments;

use App\Http\Requests\ApiFormRequest;

class UpdateSeatsRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'available_seats' => ['required', 'integer'],
        ];
    }
}

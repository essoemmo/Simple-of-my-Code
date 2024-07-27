<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;

class UpdateContactUsRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'message_type' => ['nullable' , 'integer'],
            'message' => ['nullable', 'string'],
        ];
    }
}

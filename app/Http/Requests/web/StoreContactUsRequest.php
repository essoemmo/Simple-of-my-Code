<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;

class StoreContactUsRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email','max:255','unique:contact_us,email'],
            'phone' => ['required', 'string', 'max:15','unique:contact_us,phone'],
            'message_type' => ['required' , 'integer'],
            'message' => ['nullable', 'string'],
        ];
    }
}

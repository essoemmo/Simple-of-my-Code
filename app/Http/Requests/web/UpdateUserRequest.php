<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore(auth('api')->id())],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth('api')->id())],
            'phone' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore(auth('api')->id())],
            'password' => 'nullable|string|min:8',
            'id_number' => 'nullable|integer',
            'gender' => 'nullable|boolean',
            'qualifications' => 'nullable|string',
            'birth_date' => 'nullable|date_format:Y-m-d',
            'age' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'integer',
        ];
    }
}

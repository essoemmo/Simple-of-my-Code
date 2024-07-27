<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateInstructorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($this->instructor->id)->whereNull('deleted_at')],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->instructor->id)->whereNull('deleted_at')],
            'phone' => ['nullable', 'string', 'digits:9','max:255', Rule::unique('users')->ignore($this->instructor->id)->whereNull('deleted_at')],
            'password' => ['nullable','string|min:8'],
            'id_number' => ['nullable','integer'],
            'gender' => ['nullable','in:1,2'],
            'qualifications' => ['nullable','string'],
            'birth_date' => ['nullable','date_format:Y-m-d'],
            'age' => ['nullable','integer'],
            'description' => ['nullable','string'],
            'status' => ['integer'],
            'nationality_id' => ['nullable','integer','exists:nationalities,id'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

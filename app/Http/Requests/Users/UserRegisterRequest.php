<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->whereNull('deleted_at')],
            'phone' => ['required', 'string', 'max:255', Rule::unique('users', 'phone')->whereNull('deleted_at')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'id_number' => ['nullable', 'digits:10', Rule::unique('user_details', 'id_number')->whereNull('deleted_at')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', 'integer', 'in:1,2'],
            'nationality_id' => ['nullable','integer', 'exists:nationalities,id'],
            'age' => ['nullable', 'integer'],
            'qualifications' => ['nullable', 'string', 'max:655'],
            'birth_date' => ['nullable', 'date', 'before:today', 'date_format:Y-m-d'],
            'gender' => ['nullable', 'integer', 'in:1,2'],
            'description' => ['nullable', 'string', 'max:655'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'birth_date' => $this->birth_date ? convert2english($this->birth_date) : null,
        ]);
    }
}

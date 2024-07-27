<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->whereNull('deleted_at')],
            'phone' => ['required', 'string', 'max:255', Rule::unique('users', 'phone')->whereNull('deleted_at')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'status' => ['required', 'integer', 'in:1,2'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

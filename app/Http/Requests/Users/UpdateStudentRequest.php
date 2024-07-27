<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
    use Illuminate\Validation\Rule;

class UpdateStudentRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($this->student->id)->whereNull('deleted_at')],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->student->id)->whereNull('deleted_at')],
            'phone' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($this->student->id)->whereNull('deleted_at')],
            'password' => ['nullable','string','min:8','confirmed'],
            'password_confirmation' => ['required_with:password', 'string', 'min:8'],
            'status' => ['nullable','in:1,2'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

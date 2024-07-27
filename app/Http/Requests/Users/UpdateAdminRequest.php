<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('admins')->ignore($this->admin->id)->whereNull('deleted_at')],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($this->admin->id)->whereNull('deleted_at')],
            'phone' => ['nullable', 'string', 'max:255', Rule::unique('admins')->ignore($this->admin->id)->whereNull('deleted_at')],
            'whatsapp' => ['nullable', 'string', 'max:255', Rule::unique('admins')->ignore($this->admin->id)->whereNull('deleted_at')],
            'id_number' => ['nullable','integer','digits:10',Rule::unique('admins')->ignore($this->admin->id)->whereNull('deleted_at')],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'role_id' => ['nullable', 'exists:roles,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['string', 'min:8'],
            'birth_date' => ['nullable', 'date_format:Y-m-d'],
            'join_date' => ['nullable', 'date_format:Y-m-d'],
            'address' => ['nullable', 'string', 'max:455'],
            'description' => ['nullable', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric'],
            'age' => ['nullable','integer'],
            'gender' => ['nullable','in:1,2'],
            'nationality_id' => ['nullable','integer','exists:nationalities,id'],
            'employee_number' => ['nullable','integer'],
            'job_type' => ['nullable','integer'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'password' => bcrypt($this->password),
        ]);
    }
}

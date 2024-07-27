<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'role_id' => ['required', 'integer', 'exists:roles,id','not_in:1'],
            'nationality_id' => ['required', 'integer', 'exists:nationalities,id'],
            'qualifications' => ['required', 'string', 'max:655'],
            'name' => ['required', 'string', 'max:255', Rule::unique('admins')->whereNull('deleted_at')],
            'email' => ['required', 'string', 'email', 'max:155',Rule::unique('admins','email')->whereNull('deleted_at')],
            'password' => ['required', 'min:8', 'confirmed'],

            'phone' => ['required', 'string',Rule::unique('admins','phone')->whereNull('deleted_at')],
            'birth_date' => ['required', 'date', 'before:today', 'date_format:Y-m-d'],
            'id_number' => ['required', 'digits:10',Rule::unique('admins','id_number')->whereNull('deleted_at')],
            'gender' => ['required', 'integer'],
            'age' => ['required', 'integer'],

            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
            'whatsapp' => ['nullable', 'string', 'max:255',Rule::unique('admins','whatsapp')->whereNull('deleted_at')],
            'join_date' => ['nullable', 'date', 'before_or_equal:today', 'date_format:Y-m-d'],
            'address' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'employee_number' => ['nullable', 'integer'],
            'job_type' => ['nullable', 'integer'],
        ];
    }
}

<?php

namespace App\Http\Requests\Departments;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:departments,id'],
            'name_ar' => ['required', 'string', 'max:255',Rule::unique('departments','name_ar')->whereNull('deleted_at')],
            'name_en' => ['required', 'string', 'max:255',Rule::unique('departments','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests\Departments;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:departments,id'],
            'name_ar' => ['string', 'max:255', Rule::unique('departments')->ignore($this->department->id)->whereNull('deleted_at')],
            'name_en' => ['string', Rule::unique('departments')->ignore($this->department->id)->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'description_ar' => ['string'],
            'description_en' => ['string'],
            'status' => ['nullable','integer'],
        ];
    }
}

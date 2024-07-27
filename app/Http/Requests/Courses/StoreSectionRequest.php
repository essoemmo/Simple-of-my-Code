<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:sections,id'],
            'name_ar' => ['required', 'string', 'max:255',Rule::unique('sections','name_ar')->whereNull('deleted_at')],
            'name_en' => ['required', 'string', 'max:255',Rule::unique('sections','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

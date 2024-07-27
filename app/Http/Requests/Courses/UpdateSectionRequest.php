<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable', 'exists:sections,id'],
            'name_ar' => ['string', 'max:255', Rule::unique('sections')->ignore($this->section->id)->whereNull('deleted_at')],
            'name_en' => ['string','max:255', Rule::unique('sections')->ignore($this->section->id)->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'description_ar' => ['string'],
            'description_en' => ['string'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

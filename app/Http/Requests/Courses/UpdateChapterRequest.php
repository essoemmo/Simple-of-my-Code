<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateChapterRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => ['string', 'max:255', Rule::unique('chapters')->ignore($this->chapter->id)->whereNull('deleted_at')],
            'name_en' => ['string', 'max:255', Rule::unique('chapters')->ignore($this->chapter->id)->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
        ];
    }
}

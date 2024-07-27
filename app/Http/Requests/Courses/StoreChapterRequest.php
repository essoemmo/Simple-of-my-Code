<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreChapterRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name_ar' => ['required', 'string', 'max:255',Rule::unique('chapters','name_ar')->whereNull('deleted_at')],
            'name_en' => ['required', 'string', 'max:255',Rule::unique('chapters','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'status' => ['boolean'],
        ];
    }
}

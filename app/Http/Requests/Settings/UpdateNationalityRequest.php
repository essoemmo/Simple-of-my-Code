<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\ApiFormRequest;
use App\Models\Users\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateNationalityRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name_en' => ['nullable', 'string', 'max:255',Rule::unique('nationalities','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/',Rule::unique('nationalities')->ignore($this->nationality->id)],
            'name_ar' => ['nullable', 'string',Rule::unique('nationalities','name_ar')->whereNull('deleted_at'), 'max:255',Rule::unique('nationalities')->ignore($this->nationality->id)],
            'code' => ['nullable', 'string', 'max:255',Rule::unique('nationalities','code')->whereNull('deleted_at')],
            'status' => ['nullable', 'integer'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

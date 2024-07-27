<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreNationalityRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255',Rule::unique('nationalities','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'name_ar' => ['required', 'string',Rule::unique('nationalities','name_en')->whereNull('deleted_at'), 'max:255'],
            'code' => ['required', 'string', 'max:255',Rule::unique('nationalities','code')->whereNull('deleted_at')],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKidRequest extends ApiFormRequest
{

    public function rules()
    {

        return [
            'name' => ['nullable','string','max:255'],
            'email' => ['nullable','string','email','max:255',Rule::unique('users')->ignore($this->kid_id)],
            'phone' => ['nullable','string','max:255',Rule::unique('users')->ignore($this->kid_id)],
            'id_number' => ['nullable','string','max:255',Rule::unique('users')->ignore($this->kid_id)],
            'password' => ['nullable','string','min:6'],
            'birthday' => ['nullable','date'],
            'image' => ['nullable','mimes:png,jpg,jpeg,webp','max:2048'],
            'type_id'      => ['nullable','in:4'],
            'language_id'      => ['nullable'],
            'sex_id'      => ['nullable'],
            'blood_type'      => ['nullable'],
            'description'      => ['nullable'],
        ];
    }
}

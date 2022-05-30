<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetting extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'facebook' => ['required', 'url'],
            'instagram' => ['required', 'url'],
            'twitter' => ['required', 'url'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'whatsapp' => ['nullable'],
            'description_ar' => ['string'],
            'description_en' => ['string'],
        ];
    }
}

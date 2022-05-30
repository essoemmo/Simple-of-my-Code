<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSection extends FormRequest
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
            'title_ar' => ['string', 'max:255'],
            'title_en' => ['string', 'max:255'],
            'description_ar' => ['string'],
            'description_en' => ['string'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg|max:2048'],
            'type' => ['string', 'max:255'],
            'url' => ['string', 'max:255', 'nullable'],
        ];
    }
}

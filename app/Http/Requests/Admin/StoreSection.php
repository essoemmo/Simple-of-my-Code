<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
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
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg|max:2048'],
            'type' => ['required','string', 'max:255'],
            'url' => ['string', 'max:255', 'nullable'],
        ];
    }
}

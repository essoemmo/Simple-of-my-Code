<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubSection extends FormRequest
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
            'section_id' => ['exists:sections,id'],
            'title_ar'   => [ 'string', 'max:255','nullable'],
            'title_en'   => [ 'string', 'max:255','nullable'],
            'description_ar' => [ 'string','nullable'],
            'description_en' => [ 'string','nullable'],
            'image'          => ['image','mimes:jpeg,png,jpg,gif,svg|max:2048','nullable'],
        ];
    }
}

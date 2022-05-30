<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'short_desc_ar' => ['required', 'string', 'max:255'],
            'short_desc_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string', 'max:255'],
            'main_price' => ['required', 'numeric'],
            'image' => ['required', 'image'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],   
        ];
    }
}

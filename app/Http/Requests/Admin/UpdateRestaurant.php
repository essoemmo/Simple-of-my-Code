<?php

namespace App\Http\Requests\Admin;

use App\Models\Restaurant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurant extends FormRequest
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
        $restaurant = Restaurant::findOrFail($this->restaurant);
        return [
            'name'    => ['string'],
            'phone'   => ['string', Rule::unique('restaurants')->ignore($restaurant->id)],
            'email'   => ['string','email', Rule::unique('restaurants')->ignore($restaurant->id)],
            'address' => ['required','string'],
            'image'   => ['nullable','image','mimes:jpeg,jpg,png,gif'],
            'cover'   => ['nullable','image','mimes:jpeg,jpg,png,gif'],
            'lat'    =>  ['string'],
            'lang'    =>  ['string'],
        ];
    }
}

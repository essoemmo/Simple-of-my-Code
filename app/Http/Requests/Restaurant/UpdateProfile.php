<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfile extends FormRequest
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
            'name'         => ['string'],
            'phone'        => ['string', Rule::unique('restaurants')->
                          ignore(auth('restaurant')->user()->id)],
            'email'        => ['string','email', Rule::unique('restaurants')->
                          ignore(auth('restaurant')->user()->id)],
            'lat'          => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lang'         => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'address'      => ['string'],
            'password'     => ['string', 'min:8', 'confirmed'],
            'image'        => ['mimes:png,jpg'],
            'cover'        => ['mimes:png,jpg'],
            'from'         => ['string'],
            'to'           => ['string'],
            'resrv_numb'   => ['numeric']
        ];
    }
}

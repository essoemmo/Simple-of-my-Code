<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name'     => ['required','string'],
            'phone'    => ['required','string','unique:users'],
            'email'    => ['required','string','email','unique:users'],
            'address'  => ['required','string'],
            'password' => ['required','string','min:8','confirmed'],
            'image'   =>  ['required','nullable','image','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
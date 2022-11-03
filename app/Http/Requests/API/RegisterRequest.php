<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\ApiFormRequest;

class RegisterRequest extends ApiFormRequest
{
    private $rules = [
        '1'=>
            [
                'name' => ['required','string','max:255'],
                'email' => ['required','string','email','max:255','unique:users'],
                'phone' => ['required','string','max:255','unique:users'],
                'id_number' => ['required','string','max:255','unique:users'],
                'password' => ['required','string','min:8','confirmed'],
                'image' => ['required','mimes:png,jpg,jpeg,webp','max:2048'],
                'relation_id' => ['required'],
                'national_id' => ['required'],
                'city_id' => ['required','exists:cities,id'],
                'type_id'      => ['required','in:1'],
            ],
        '4'=>
            [
                'name' => ['required','string','max:255'],
                'email' => ['required','string','email','max:255','unique:users'],
                'phone' => ['required','string','max:255','unique:users'],
                'id_number' => ['required','string','max:255','unique:users'],
                'password' => ['required','string','min:8'],
                'birthday' => ['required','date'],
                'image' => ['required','mimes:png,jpg,jpeg,webp','max:2048'],
                'type_id'      => ['required','in:4'],
                'language_id'      => ['required'],
                'sex_id'      => ['required'],
                'blood_type'      => ['required'],
                'description'      => ['nullable'],
            ],
        '3' =>
            [
                'name' => ['required','string','max:255'],
                'manager_name' => ['required','string','max:255'],
                'email' => ['required','string','email','max:255','unique:users'],
                'password' => ['required','string','min:8','confirmed'],
                'phone' => ['required','string','max:255','unique:users'],
                'id_number' => ['required','string','max:255','unique:users'],
                'image' => ['required','mimes:png,jpg,jpeg,webp','max:2048'],
                'commercial' => ['required','mimes:pdf','max:255'],
                'city_id' => ['required','exists:cities,id'],
                'user_id' => ['nullable'],
                'type_id'      => ['required','in:3'],

            ],
        '2' =>
            [
                'name' => ['required','string','max:255'],
                'manager_name' => ['required','string','max:255'],
                'manager_phone' => ['required','string','max:255','unique:users'],
                'email' => ['required','string','email','max:255','unique:users'],
                'password' => ['required','string','min:8','confirmed'],
                'phone' => ['required','string','max:255','unique:users'],
                'id_number' => ['required','string','max:255','unique:users'],
                'image' => ['required','mimes:png,jpg,jpeg,webp','max:2048'],
                'commercial' => ['required','mimes:pdf','max:255'],
                'national_address' => ['required','max:255'],
                'type_id'      => ['required','in:2'],
            ],
    ];

    public function rules()
    {
        return $this->rules[$this->type_id];
    }


}

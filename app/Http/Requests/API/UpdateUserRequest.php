<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\API\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends ApiFormRequest
{
    private $rules;
    private function init(){
        $userId = auth()->id();
        $rules = [
            '1'=>
                [
                    'name' => ['nullable','string','max:255'],
                    'email' => ['nullable','string','email','max:255',Rule::unique('users')->ignore($userId)],
                    'phone' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'id_number' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'password' => ['nullable','string','min:6'],
                    'birthday' => ['nullable','date'],
                    'image' => ['nullable','mimes:png,jpg,jpeg,webp','max:255'],
                    'relation_id' => ['nullable'],
                    'national_id' => ['nullable'],
                    'city_id' => ['nullable'],
                ],
            '3' =>
                [
                    'name' => ['nullable','string','max:255'],
                    'email' => ['nullable','string','email','max:255',Rule::unique('users')->ignore($userId)],
                    'password' => ['nullable','string','min:6'],
                    'phone' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'id_number' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'image' => ['nullable','mimes:png,jpg,jpeg,webp','max:255'],
                    'commercial' => ['nullable','mimes:pdf','max:255'],
                    'city_id' => ['nullable','exists:cities,id'],
                    'user_id' => ['nullable'],

                ],
            '2' =>
                [
                    'name' => ['nullable','string','max:255'],
                    'manager_name' => ['nullable','string','max:255'],
                    'manager_phone' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'email' => ['nullable','string','email','max:255',Rule::unique('users')->ignore($userId)],
                    'password' => ['nullable','string','min:6'],
                    'phone' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'id_number' => ['nullable','string','max:255',Rule::unique('users')->ignore($userId)],
                    'image' => ['nullable','mimes:png,jpg,jpeg,webp','max:255'],
                    'commercial' => ['nullable','mimes:pdf','max:255'],
                    'city_id' => ['nullable','exists:cities,id'],
                ],
        ];
        $this->rules = $rules[auth()->user()->type_id];
    }
    public function rules()
    {
        $this->init();
        return $this->rules;
    }
}

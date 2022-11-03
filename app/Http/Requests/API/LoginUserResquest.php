<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\API\ApiFormRequest;

class LoginUserResquest extends ApiFormRequest
{

    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255','exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }
}

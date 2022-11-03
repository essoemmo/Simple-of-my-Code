<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\ApiFormRequest;

class ResetCodeResquest extends ApiFormRequest
{ 
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
        ];
    }
}

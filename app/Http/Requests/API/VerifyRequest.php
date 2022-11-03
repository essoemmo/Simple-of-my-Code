<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\ApiFormRequest;

class VerifyRequest extends ApiFormRequest
{
   
    public function rules()
    {
        return [
            'code'  => ['required', 'numeric'],
        ];
    }
}

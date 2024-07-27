<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserVerifyRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'code' => ['required', 'exists:users,code',"digits:6"],
        ];
    }
}

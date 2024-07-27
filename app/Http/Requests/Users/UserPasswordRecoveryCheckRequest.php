<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRecoveryCheckRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'code' => ['required', 'exists:admins,code',"digits:6"],
            'email' => ['required', 'email', 'exists:admins,email']
        ];
    }
}

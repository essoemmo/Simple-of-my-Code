<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;

class AdminPasswordRecoveryReset extends ApiFormRequest
{
        public function rules(): array
    {
        return [
            'email'=> ['required','exists:admins,email'],
            'password'=> ['required','confirmed','min:8',"regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"],
            'password_confirmation' => ['required','min:8']
        ];
    }
}

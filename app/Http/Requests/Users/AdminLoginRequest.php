<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class AdminLoginRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists('admins', 'email')],
            'password' => ['required', 'string', 'min:8'],
           // 'fcm_token' => ['required', 'string', 'max:255'],
        ];
    }
}

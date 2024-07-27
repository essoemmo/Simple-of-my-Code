<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserLoginRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')->whereNull('deleted_at')],
            'password' => ['required', 'string', 'min:8'],
            //'fcm_token'=> ['required', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserCheckActivationCodeRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'code' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        ];
    }
}

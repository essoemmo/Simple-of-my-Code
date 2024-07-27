<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminRecoveryEmailRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
           'email' => ['required', 'email', 'exists:admins,email']
        ];
    }
}

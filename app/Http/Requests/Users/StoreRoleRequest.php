<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/[a-zA-Z]/'],
            'permissions' => ['required', 'array', 'min:1'],
            'permissions.*' => ['exists:permissions,name', 'regex:/^[a-zA-Z0-9_-]+-[a-zA-Z0-9_-]+$/'],
        ];
    }
}

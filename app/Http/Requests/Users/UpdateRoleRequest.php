<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends ApiFormRequest
{
    public function rules(): array
    {
        $rolesNames= ['admin', 'manager', 'human_resource', 'employee'];
        return [
            'name' => [
                'nullable',
                Rule::unique('roles')->ignore($this->role),
                function ($name, $value, $fail) use ($rolesNames) {
                    if (in_array($this->role->name, $rolesNames) && $value !== $this->role->name) {
                        $fail (__('application.The name cannot be changed for this role'));
                    }
                },
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['exists:permissions,name'],
        ];
    }
}

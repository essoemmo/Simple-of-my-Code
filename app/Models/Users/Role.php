<?php

namespace App\Models\Users;

use Laratrust\Models\Role as RoleModel;
use App\Traits\Filterable;

class Role extends RoleModel
{
    use Filterable;

    public $guarded = [];

    protected array $filterableColumns = [
        'name' => 'like',
    ];

    public function scopeWithoutRoleSuperAdmin($query)
    {
        return $query->where('name', '!=', 'super_admin');
    }

}

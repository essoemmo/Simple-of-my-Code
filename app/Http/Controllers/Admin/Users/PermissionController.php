<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\Users\ActionEnum;
use App\Enums\Users\AdminSectionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Roles\ActionResource;
use App\Http\Resources\Roles\AdminSectionResource;
use App\Http\Resources\Roles\PermissionResource;
use App\Models\Users\Role;
use App\Traits\ResponseTrait;

class PermissionController extends Controller
{
    use ResponseTrait;

    public function getPermissionsByRole(Role $role)
    {
        return self::successResponse(data: PermissionResource::collection($role->permissions));
    }

    public function adminSections()
    {
        return self::successResponse(data: AdminSectionResource::collection(AdminSectionEnum::cases()));
    }

    public function actions()
    {
        return self::successResponse(data: ActionResource::collection(ActionEnum::cases()));
    }
}

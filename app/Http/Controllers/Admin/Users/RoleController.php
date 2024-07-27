<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Users\StoreRoleRequest;
use App\Http\Requests\Users\UpdateRoleRequest;
use App\Http\Resources\Roles\RoleResource;
use App\Models\Users\Role;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ResponseTrait;

    //TODO: list of roles
    /**
     * @param Request $request
     * @param Role $role
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Role $role,PageRequest $pageRequest) {

        $roles = Role::withoutRoleSuperAdmin()->filter($request, (array)$role->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: RoleResource::collection($roles)->response()->getData(true));
    }
//TODO: show role
    /**
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        return self::successResponse(data: RoleResource::make($role));
    }
//TODO: store new role
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->only('name'));
        $role->givePermissions($request->permissions);

        return self::successResponse(message: __('application.added'),data: RoleResource::make($role));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->safe()->except('permissions'));
        $role->syncPermissions($request->permissions);

        return self::successResponse(message: __('application.updated'),data: RoleResource::make($role));
    }

    public function destroy(Role $role)
    {

        $restrictedNames = ['admin', 'manager', 'human_resource', 'employee'];

        // Check if the role name is in the restricted names array
        if (in_array($role->name, $restrictedNames)) {
            return self::failResponse(400, message: __('application.This role cannot be deleted'));
        }

        if($role->users()->count() > 0) {
            return self::failResponse(400,message: __('application.role_has_users'));
        }
        $role->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

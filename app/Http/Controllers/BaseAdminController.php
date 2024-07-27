<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseAdminController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function adminPermissions(string $type, bool $read, bool $create, bool $update, bool $delete): void
    {
        $permissionMap = [
            'read' => 'index',
            'create' => 'store',
            'update' => 'update',
            'delete' => 'destroy',
        ];

        $grantedPermissions = array_filter(
            $permissionMap,
            function ($permission) use ($read, $create, $update, $delete) {
                return $$permission; // Access variables directly using double dollar syntax
            }
        );

        $this->middleware(
            'permission:'.$type.'-'.implode(',', array_keys($grantedPermissions)),
            ['only' => array_values($grantedPermissions)]
        );
    }
}

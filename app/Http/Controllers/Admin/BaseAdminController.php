<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseAdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function permissionsAdmin($type,$read,$create,$update,$delete)
    {
        if ($read) {
            $this->middleware('permission:'.$type.'-read', ['only' => ['index']]);
        }
        if ($create) {
            $this->middleware('permission:'.$type.'-create', ['only' => ['store']]);
        }
        if ($update) {
            $this->middleware('permission:'.$type.'-update', ['only' => ['update']]);
        }
        if ($delete) {
            $this->middleware('permission:'.$type.'-delete', ['only' => ['destroy']]);
        }
    }
}

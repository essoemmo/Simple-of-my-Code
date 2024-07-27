<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\ActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Departments\DepartmentResource;
use App\Http\Resources\Departments\MainDepartmentResource;
use App\Models\Departments\Department;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use ResponseTrait;
    public function allDepartments(Request $request, Department $department)
    {
        $departments = Department::whereParentId(null)->filter($request, (array)$department->filterableColumns)->where('status', ActiveEnum::active->value)->get();

        return self::successResponse(data: MainDepartmentResource::collection($departments));
    }

}

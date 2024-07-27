<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\StoreDepartmentRequest;
use App\Http\Requests\Departments\UpdateDepartmentRequest;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Departments\DepartmentResource;
use App\Http\Resources\Departments\MainDepartmentResource;
use App\Models\Departments\Department;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use ResponseTrait;

//TODO: list of departments and sub departments

    /**
     * @param Request $request
     * @param Department $department
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Department $department, PageRequest $pageRequest)
    {
        $departments = Department::whereParentId(null)->filter($request, (array)$department->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: DepartmentResource::collection($departments)->response()->getData(true));
    }

    public function mainDepartments(Request $request, Department $department)
    {
        $department = Department::whereParentId(null)->filter($request, (array)$department->filterableColumns)->get();

        return self::successResponse(data: MainDepartmentResource::collection($department));
    }


//TODO: list of sub departments

    /**
     * @param Request $request
     * @param Department $department
     * @return JsonResponse
     */
    public function subDepartments(Request $request, Department $department)
    {
        $departments = $department->departments()->filter($request, (array)$department->filterableColumns)->paginate(10);

        return self::successResponsePaginate(data: DepartmentResource::collection($departments)->response()->getData(true));
    }

//TODO: add new department

    /**
     * @param StoreDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $department = Department::create($request->validated());

        return self::successResponse(message: __('application.added'), data: DepartmentResource::make($department));
    }
//TODO: show specific department

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department)
    {
        return self::successResponse(data: DepartmentResource::make($department));
    }
//TODO: update specific department

    /**
     * @param UpdateDepartmentRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $department->update($request->validated());

        return self::successResponse(message: __('application.updated'), data: DepartmentResource::make($department));
    }

//TODO: delete specific department

    /**
     * @param Department $department
     * @return JsonResponse
     */

    public function destroy(Department $department)
    {
        if ($department->admins()->count() > 0) {
            return self::failResponse(400, message: __('application.cannot_delete'));
        }
        $department->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

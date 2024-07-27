<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Users\StoreAdminRequest;
use App\Http\Requests\Users\UpdateAdminRequest;
use App\Http\Resources\Users\AdminResource;
use App\Logging\ActivityLogging;
use App\Models\Users\Admin;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use ResponseTrait;

    protected ActivityLogging $logger;

    //TODO: activity logging constructor

    /**
     * @param ActivityLogging $logger
     */
    public function __construct(ActivityLogging $logger)
    {
        $this->logger = $logger;
    }

    //TODO: show all admins

    /**
     * @param Request $request
     * @param Admin $admin
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Admin $admin, PageRequest $pageRequest): JsonResponse
    {
        $admins = Admin::adminSearch($request)->withoutSuperAdmin()->filter($request, (array)$admin->filterableColumns)
            ->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: AdminResource::collection($admins)->response()->getData(true));
    }


    //TODO: store new admin

    /**
     * @param StoreAdminRequest $request
     * @return JsonResponse
     */
    public function store(StoreAdminRequest $request): JsonResponse
    {
        $adminData = $request->safe()->except('role_id','password');
        $adminData['password'] = bcrypt($request->password);
        $adminData['code'] = generate_verification_code();
        $admin = Admin::create($adminData);

        if ($request->attachments) {
            $admin->assignAttachment($request->attachments);
        }

        $admin->syncRoles([$request->role_id]);

        return self::successResponse(message: __('application.added'), data: AdminResource::make($admin));
    }
    //TODO: show admin

    /**
     * @param Admin $admin
     * @return JsonResponse
     */
    public function show(Admin $admin)
    {
       // dd($admin->roles()->get());
        return self::successResponse(data: AdminResource::make($admin));
    }

    //TODO: get admins by department

    /**
     * @param int $departmentId
     * @param Request $request
     * @param Admin $admin
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function adminsByDepartmentId(
        int $departmentId,
        Request $request,
        Admin $admin,
        PageRequest $pageRequest
    ): JsonResponse {
        $admins = Admin::where('department_id', $departmentId)
            ->filter($request, (array)$admin->filterableColumns)
            ->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: AdminResource::collection($admins)->response()->getData(true));
    }

//TODO: update admin

    /**
     * @param UpdateAdminRequest $request
     * @param Admin $admin
     * @return JsonResponse
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $adminData = $request->safe()->except('password', 'role_id');

        if ($request->attachments) {
            $admin->assignAttachment($request->attachments);
        }

        $admin->update($adminData);

        if ($request->role_id)
            $admin->syncRoles([$request->role_id]);

        return self::successResponse(message: __('admin.updated'), data: AdminResource::make($admin));
    }

    //TODO: delete admin

    /**
     * @param Admin $admin
     * @return JsonResponse
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return self::successResponse(message: __('application.deleted'));
    }


}

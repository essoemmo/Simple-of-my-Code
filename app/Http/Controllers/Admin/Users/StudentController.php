<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Users\StoreStudentRequest;
use App\Http\Requests\Users\UpdateStudentRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param User $user
     * @param Request $request
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(User $user, Request $request, PageRequest $pageRequest): jsonResponse
    {
        $students = User::student()->filter($request, (array)$user->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: UserResource::collection($students)->response()->getData(true));
    }

    public function show(User $student): jsonResponse
    {
        return self::successResponse(data: UserResource::make($student));
    }

    /**
     * @param StoreStudentRequest $request
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request): jsonResponse
    {
        $StudentData = $request->validated();
        $StudentData['type'] = UserTypeEnum::student->value;

        $StudentData = $this->userService->createUser($StudentData, null, $request->attachments);

        return self::successResponse(message: __('application.added'),data: UserResource::make($StudentData));
    }

    /**
     * @param UpdateStudentRequest $request
     * @param User $student
     * @return JsonResponse
     */
    public function update(UpdateStudentRequest $request, User $student): jsonResponse
    {
        $StudentData = $request->validated();

        $StudentData= $this->userService->updateUser($StudentData, null, $request->attachments, $student);

        return self::successResponse(message: __('application.updated'),data: UserResource::make($StudentData));
    }

    /**
     * @param User $student
     * @return JsonResponse
     */
    public function destroy(User $student): jsonResponse
    {
        $student->userDetail()->delete();
        $student->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

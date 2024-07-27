<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\Options\ActiveEnum;
use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Users\StoreInstructorRequest;
use App\Http\Requests\Users\UpdateInstructorRequest;
use App\Http\Resources\Users\InstructorResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    use ResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @param User $instructor
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, User $instructor, PageRequest $pageRequest): jsonResponse
    {
        $instructors = User::instructor()->filter($request, (array)$instructor->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: UserResource::collection($instructors)->response()->getData(true));
    }
    public function getInstructorList()
    {
        $instructors = User::instructor()->get();

        return self::successResponse(data: InstructorResource::collection($instructors));
    }

    /**
     * @param User $instructor
     * @return JsonResponse
     */
    public function show(User $instructor): jsonResponse
    {
        return self::successResponse(data: UserResource::make($instructor));
    }

    /**
     * @param StoreInstructorRequest $request
     * @return JsonResponse
     */
    public function store(StoreInstructorRequest $request): jsonResponse
    {
        $instructorData = $request->safe()->only('name', 'phone', 'email', 'password','nationality_id');
        $instructorDetailsData = $request->safe()->except('name', 'phone', 'email', 'password','nationality_id');

        $instructorData['type'] = UserTypeEnum::instructor->value;
        $instructorData['status'] = ActiveEnum::active->value;

        $instructorData = $this->userService->createUser($instructorData, $instructorDetailsData, $request->attachments);

        return self::successResponse(message: __('application.added'),data: UserResource::make($instructorData));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function changeInstructorStatus(User $user, Request $request)
    {
        $user->update(['status' => $request->status]);

        return self::successResponse(message: __('application.request_answered'));
    }


    /**
     * @param UpdateInstructorRequest $request
     * @param User $instructor
     * @return JsonResponse
     */
    public function update(UpdateInstructorRequest $request, User $instructor): jsonResponse
    {
        $instructorData = $request->safe()->only('name', 'phone', 'email', 'password','nationality_id');
        $instructorDetailsData = $request->safe()->except('name', 'phone', 'email', 'password','nationality_id');

        $instructorData = $this->userService->updateUser($instructorData, $instructorDetailsData, $request->attachments, $instructor);

        return self::successResponse(message: __('application.updated'),data: UserResource::make($instructorData));
    }

    /**
     * @param User $instructor
     * @return JsonResponse
     */
    public function destroy(User $instructor): jsonResponse
    {
        $instructor->userDetail()->delete();
        $instructor->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

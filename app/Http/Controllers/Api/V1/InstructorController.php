<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\ActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Users\InstructorResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    use ResponseTrait;

    public function allInstructors(Request $request, User $instructor,PageRequest $pageRequest)
    {
        $instructors = User::instructor()->filter($request, (array)$instructor->filterableColumns)->where('status', ActiveEnum::active->value)->paginate($pageRequest->page_count);
        return self::successResponsePaginate(data: UserResource::collection($instructors)->response()->getData(true));
    }

    public function instructorDetails(User $instructor): jsonResponse
    {
        return self::successResponse(data: InstructorResource::make($instructor));
    }

}

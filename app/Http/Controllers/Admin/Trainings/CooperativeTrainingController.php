<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\UpdateSeatsRequest;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Trainings\AnswerCooperativeTrainingRequest;
use App\Http\Resources\Departments\DepartmentResource;
use App\Http\Resources\Trainings\CooperativeTrainingResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Departments\Department;
use App\Models\Training\CooperativeTraining;
use App\Models\Users\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CooperativeTrainingController extends Controller
{
    use ResponseTrait;

//TODO: list of training needs requests

    /**
     * @param Request $request
     * @param CooperativeTraining $cooperativeTraining
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function getTrainingNeedsRequests(
        Request $request,
        CooperativeTraining $cooperativeTraining,
        PageRequest $pageRequest
    ) {
        $trainings = CooperativeTraining::filter($request, (array)$cooperativeTraining->filterableColumns)->paginate(
            $pageRequest->page_count
        );

        return self::successResponsePaginate(
            data: CooperativeTrainingResource::collection($trainings)->response()->getData('true')
        );
    }

//TODO: get all available seats

    /**
     * @return JsonResponse
     */
    public function getDepartments()
    {
        $departments = Department::availableSeats()->get();

        return self::successResponse(data: DepartmentResource::collection($departments));
    }

//TODO: update seats

    /**
     * @param UpdateSeatsRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function updateDepartmentSeats(UpdateSeatsRequest $request, Department $department)
    {
        $department->update($request->validated());

        return self::successResponse(message: __('application.updated'));
    }

//TODO: answer training request
    public function answerTrainingRequest(
        CooperativeTraining $cooperativeTraining,
        AnswerCooperativeTrainingRequest $request
    ) {
        $cooperativeTraining->update($request->validated());

        return self::successResponse(message: __('application.request_answered'));
    }
//TODO: get all students

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllStudents(Request $request)
    {
        $cooperativeTrainingUsers = CooperativeTraining::whereStatus($request->status)->pluck('user_id')->toArray();
        $users = User::whereIn('id', $cooperativeTrainingUsers)->paginate(10);

        return self::successResponsePaginate(data: UserResource::collection($users)->response()->getData('true'));
    }
//TODO: get department students

    /**
     * @param Department $department
     * @param Request $request
     * @return JsonResponse
     */
    public function getDepartmentStudents(Department $department, Request $request)
    {
        $cooperativeTrainingUsers = CooperativeTraining::whereStatus($request->status)->where(
            'department_id',
            $department->id
        )->pluck('user_id')->toArray();
        $users = User::whereIn('id', $cooperativeTrainingUsers)->paginate(10);

        return self::successResponsePaginate(data: UserResource::collection($users)->response()->getData('true'));
    }
//TODO: delete training request

    /**
     * @param CooperativeTraining $cooperativeTraining
     * @return JsonResponse
     */
    public function deleteTrainingRequest(CooperativeTraining $cooperativeTraining)
    {
        $cooperativeTraining->delete();

        return self::successResponse(message: __('application.deleted'));
    }

}

<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trainings\StoreLectureScheduleRequest;
use App\Http\Requests\Trainings\UpdateLectureScheduleRequest;
use App\Http\Resources\Trainings\LectureScheduleResource;
use App\Models\training\LectureSchedule;
use App\Traits\ResponseTrait;

class LectureScheduleController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $LectureSchedules = LectureSchedule::all();
        return self::successResponse(data: LectureScheduleResource::collection($LectureSchedules)->response()->getData(true));
    }

    public function store(StoreLectureScheduleRequest $request)
    {
        $LectureSchedule = LectureSchedule::create($request->validated());
        return self::successResponse(__('application.added'),LectureScheduleResource::make($LectureSchedule));
    }

    public function update(UpdateLectureScheduleRequest $request, LectureSchedule $LectureSchedule)
    {
        $LectureSchedule->update($request->validated());
        return self::successResponse(__('application.updated'),LectureScheduleResource::make($LectureSchedule));
    }

    public function destroy(LectureSchedule $LectureSchedule)
    {
        $LectureSchedule->delete();
        return self::successResponse(message: __('application.deleted'));
    }


}

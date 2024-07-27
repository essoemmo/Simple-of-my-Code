<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trainings\StoreMandatoryScheduleRequest;
use App\Http\Requests\Trainings\UpdateMandatoryScheduleRequest;
use App\Models\training\LectureSchedule;
use App\Models\Training\MandatoryLecture;
use App\Services\TrainingService;
use App\Traits\ResponseTrait;

class MandatoryLectureScheduleController extends Controller
{
    use ResponseTrait;
    private TrainingService $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function create(StoreMandatoryScheduleRequest $request, LectureSchedule $lectureSchedule)
    {
        $lectureData = $request->safe()->except('lectures');
        $lecture = MandatoryLecture::create($lectureData);

        $lectureTimes = $request->safe()->only('lectures');
        $this->trainingService->createLectureTimes($lectureTimes, $lecture);

        $lectureSchedule->mandatoryLectures()->create(['mandatory_lecture_id' => $lecture->id]);

        return $this->successResponse(__('application.added'));
    }

    public function update(UpdateMandatoryScheduleRequest $request, MandatoryLecture $mandatoryLecture)
    {
        $lectureData = $request->safe()->except('lectures');
        $mandatoryLecture->update($lectureData);

        $lectureTimes = $request->safe()->only('lectures');
        $mandatoryLecture->times()->delete();

        $this->trainingService->createLectureTimes($lectureTimes, $mandatoryLecture);

       return $this->successResponse(__('application.updated'));
    }
}

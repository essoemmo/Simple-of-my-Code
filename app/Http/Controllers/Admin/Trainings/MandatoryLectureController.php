<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Trainings\MandatoryLectureResource;
use App\Models\training\MandatoryLecture;
use App\Traits\ResponseTrait;

class MandatoryLectureController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $mandatoryLectures = MandatoryLecture::Paginate();
        return self::successResponsePaginate(data: MandatoryLectureResource::collection($mandatoryLectures)->response()->getData(true));
    }
    public function show(MandatoryLecture $mandatoryLecture)
    {
        return self::successResponse(data:MandatoryLectureResource::make($mandatoryLecture));
    }
    public function destroy(MandatoryLecture $mandatoryLecture)
    {
        $mandatoryLecture->delete();
        return self::successResponse(message: __('application.deleted'));
    }
}

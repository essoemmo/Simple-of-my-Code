<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\ActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Courses\CourseDetailsResource;
use App\Http\Resources\Courses\CourseResource;
use App\Models\Courses\Course;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ResponseTrait;

    public function allCourses(Request $request, Course $course, PageRequest $pageRequest)
    {
        $courses = Course::where('status', ActiveEnum::active)->filter($request, (array)$course->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }

    public function courseDetails(Course $course)
    {
        return self::successResponse(data: CourseDetailsResource::make($course));
    }

    public function commonCourses()
    {

    }


}

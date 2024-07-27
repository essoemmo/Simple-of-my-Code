<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Courses\CourseDetailsResource;
use App\Http\Resources\Courses\CourseResource;
use App\Models\Courses\Course;
use App\Models\Users\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ResponseTrait;

//TODO: list of courses with filter
    /**
     * @param Request $request
     * @param Course $course
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Course $course, PageRequest $pageRequest)
    {
        $courses = Course::filter($request, (array)$course->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }

//TODO: list of course with details wit-h filter
    /**
     * @param Request $request
     * @param Course $course
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function coursesWithDetails(Request $request, Course $course, PageRequest $pageRequest)
    {
        $courses = Course::filter($request, (array)$course->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseDetailsResource::collection($courses)->response()->getData(true));
    }

//TODO: show specific course with details
    /**
     * @param Course $course
     * @return JsonResponse
     */
    public function courseWithDetails(Course $course)
    {
        return self::successResponse(data: CourseDetailsResource::make($course));
    }


//TODO: create new Course
    /**
     * @param StoreCourseRequest $request
     * @return JsonResponse
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        // $instructor = User::whereType(UserTypeEnum::instructor)->find(auth('api')->user()->id);

        $courseData = $request->safe()->except('attachments', 'instructor_id');
        $courseData['instructor_id'] = $request->instructor_id;

        $course = Course::create($courseData);

        if ($request->attachments) {
            $course->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.added'),data: CourseResource::make($course));
    }

// TODO: show specific course
    /**
     * @param Course $course
     * @return JsonResponse
     */
    public function show(Course $course)
    {
        return self::successResponse(data: CourseResource::make($course));
    }

// TODO: show specific course by instructor

    /**
     * @param User $instructor
     * @param Request $request
     * @param Course $course
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function coursesByInstructor(
        User $instructor,
        Request $request,
        Course $course,
        PageRequest $pageRequest
    ): JsonResponse
    {
        $courses = Course::whereInstructor_id($instructor)
            ->filter($request, (array)$course->filterableColumns)
            ->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: CourseResource::collection($courses)->response()->getData(true));
    }


//TODO: update specific course
    /**
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return JsonResponse
     */
    public function update(UpdateCourseRequest $request, Course $course): JsonResponse
    {
        $course->update($request->validated());

        if ($request->attachments) {
            $course->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'),data: CourseResource::make($course));
    }

//TODO: delete specific course
    /**
     * @param Course $course
     * @return JsonResponse
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

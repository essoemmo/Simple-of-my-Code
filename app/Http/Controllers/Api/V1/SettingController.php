<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Courses\CourseLanguageEnum;
use App\Enums\Courses\CourseLevelEnum;
use App\Enums\Courses\CourseStatusEnum;
use App\Enums\Courses\CourseTypeEnum;
use App\Enums\Courses\VideoHostingEnum;
use App\Enums\Options\ActiveEnum;
use App\Enums\Options\GenderEnum;
use App\Enums\Options\MessageTypeEnum;
use App\Enums\Options\StatusEnum;
use App\Enums\Users\JobTypeEnum;
use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Settings\ActiveResource;
use App\Http\Resources\Settings\CourseLanguageResource;
use App\Http\Resources\Settings\CourseLevelResource;
use App\Http\Resources\Settings\CourseStatusResource;
use App\Http\Resources\Settings\CourseTypesResource;
use App\Http\Resources\Settings\GenderResource;
use App\Http\Resources\Settings\JobTypesResource;
use App\Http\Resources\Settings\MessageTypeResource;
use App\Http\Resources\Settings\SettingResource;
use App\Http\Resources\Settings\StatusResource;
use App\Http\Resources\Settings\UserTypeResource;
use App\Http\Resources\Settings\VideoHostTypesResource;
use App\Models\Web\Setting;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ResponseTrait;



    public function index(): JsonResponse
    {
        $settings = Setting::select('value', 'key');

        return self::successResponse(('application.success'),SettingResource::collection(Setting::all()));

    }

    public function updateSetting(Request $request)
    {
        collect($request->except(['_token', '_method']))
            ->each(function ($value, $key) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            });
        return self::successResponse(('application.updated'),SettingResource::collection(Setting::all()));
    }
    public function getActives()
    {
        return self::successResponse(data: ActiveResource::collection(ActiveEnum::cases()));
    }

    public function getStatus()
    {
        return self::successResponse(data: StatusResource::collection(StatusEnum::cases()));
    }

    public function getUserTypes()
    {
        return self::successResponse(data: UserTypeResource::collection(UserTypeEnum::cases()));
    }

    public function getGenders()
    {
        return self::successResponse(data: GenderResource::collection(GenderEnum::cases()));
    }

    public function getCourseLanguages()
    {
        return self::successResponse(data: CourseLanguageResource::collection(CourseLanguageEnum::cases()));
    }

    public function getCourseLevels()
    {
        return self::successResponse(data: CourseLevelResource::collection(CourseLevelEnum::cases()));
    }

    public function getCourseStatus()
    {
        return self::successResponse(data: CourseStatusResource::collection(CourseStatusEnum::cases()));
    }

    public function getCourseTypes()
    {
        return self::successResponse(data: CourseTypesResource::collection(CourseTypeEnum::cases()));
    }

    public function getJobTypes()
    {
        return self::successResponse(data: JobTypesResource::collection(JobTypeEnum::cases()));
    }

    public function getVideoHosts()
    {
        return self::successResponse(data: VideoHostTypesResource::collection(VideoHostingEnum::cases()));
    }

    public function getMessageTypes()
    {
        return self::successResponse(data: MessageTypeResource::collection(MessageTypeEnum::cases()));
    }

}

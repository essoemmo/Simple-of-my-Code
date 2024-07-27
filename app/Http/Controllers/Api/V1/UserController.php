<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\StoreReviewRequest;
use App\Http\Requests\web\UpdateUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Web\FavoriteResource;
use App\Http\Resources\web\ReviewResource;
use App\Models\Courses\Course;
use App\Models\Users\User;
use App\Models\Web\Favorite;
use App\Models\Web\Review;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function myProfile(): jsonResponse
    {
        $user = auth('api')->user();
        return self::successResponse(data: UserResource::make($user));
    }

    public function updateMyProfile(UpdateUserRequest $request): jsonResponse
    {
        $user = auth('api')->user()->id;
        $userData = $request->safe()->only('name', 'phone', 'email', 'password');
        $userDetailsData = $request->safe()->except('name', 'phone', 'email', 'password');

        $this->userService->updateUser($userData, $userDetailsData, $request->attachments, $user);

        return self::successResponse(message: __('application.updated'),data: UserResource::make($user));
    }

    public function addCourseToFavorite(Course $course)
    {
        $userId = auth('api')->user()->id;
        $alreadyFavorite = $course->favorite()->where('user_id', $userId)->exists();

        if ($alreadyFavorite) {
            return self::failResponse(400, __('application.already_added_to_favourites'));
        } else {
            $course->favorite()->create([
                'user_id' => auth('api')->user()->id
            ]);
            return self::successResponse(message: __('application.added'));
        }

    }

    public function addInstructorToFavorite(User $instructor)
    {
        if ($instructor->type != UserTypeEnum::instructor) {
            return self::failResponse(404, __('application.not_found'));
        }

        $userId = auth('api')->user()->id;
        $alreadyFavorite = $instructor->favorite()->where('user_id', $userId)->exists();

        if ($alreadyFavorite) {
            return self::failResponse(400, __('application.already_added_to_favourites'));
        } else {
            $instructor->favorite()->create([
                'user_id' =>$userId
            ]);
            return self::successResponse(message: __('application.added'));
        }
    }

    public function removeCourseFromFavorite (Course $course)
    {
        $userId = auth('api')->user()->id;
        $alreadyFavorite = $course->favorite()->where('user_id', $userId)->exists();
        if (!$alreadyFavorite) {
            return self::failResponse(400, __('application.not_added_to_favourites'));
        } else {
            $course->favorite()->where('user_id', $userId)->delete();
            return self::successResponse(message: __('application.removed'));
        }
    }

    public function removeInstructorFromFavorite (User $instructor)
    {
        $userId = auth('api')->user()->id;
        $alreadyFavorite = $instructor->favorite()->where('user_id', $userId)->exists();
        if (!$alreadyFavorite) {
            return self::failResponse(400, __('application.not_added_to_favourites'));
        } else {
            $instructor->favorite()->where('user_id', $userId)->delete();
            return self::successResponse(message: __('application.removed'));
        }
    }
    public function myFavCourses(): jsonResponse
    {
        $favourites = Favorite::where('user_id',  auth('api')->user()->id)->courses()->get();
        return self::successResponse(data: FavoriteResource::collection($favourites));
    }

    public function myFavInstructors(): jsonResponse
    {
        $favourites = Favorite::where('user_id',  auth('api')->user()->id)->instructors()->get();
        return self::successResponse(data: FavoriteResource::collection($favourites));
    }

    public function addInstructorReview(StoreReviewRequest $request, User $instructor)
    {
        $reviewData = $request->validated();
        $user_id = auth('api')->user()->id;
        $reviewData['user_id'] = $user_id;

        $instructor->review()->create($reviewData);
        return self::successResponse(message: __('application.added'));
    }

    public function addCourseReview(StoreReviewRequest $request, Course $course)
    {
        $reviewData = $request->validated();
        $user_id = auth('api')->user()->id;
        $reviewData['user_id'] = $user_id;

        $course->review()->create($reviewData);
        return self::successResponse(message: __('application.added'));
    }

    public function myReviewedCourses(): jsonResponse
    {
        $reviews = Review::where('user_id',  auth('api')->user()->id)->courses()->get();
        return self::successResponse(data: ReviewResource::collection($reviews));
    }

    public function myReviewedInstructors(): jsonResponse
    {
        $reviews = Review::where('user_id',  auth('api')->user()->id)->instructors()->get();
        return self::successResponse(data: ReviewResource::collection($reviews));
    }

}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trainings\CooperativeTrainingRequest;
use App\Models\Training\CooperativeTraining;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CooperativeTrainingRequestController extends Controller
{
    use ResponseTrait;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(CooperativeTrainingRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth('api');
            $trainingData = $request->safe()->except('attachments');

            if ($request->attachments) {
                $user->assignAttachment($request->attachments);
            }

            $trainingData['user_id'] = $user->id;
            $trainingData['status'] = StatusEnum::pending->value;
            CooperativeTraining::create($trainingData);

            DB::commit();

            return self::successResponse(message: __('application.added'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('User Service creation failed: '.$e->getMessage(), ['exception' => $e]);
            return self::failResponse(500, message: __('application.error'));
        }
    }
}

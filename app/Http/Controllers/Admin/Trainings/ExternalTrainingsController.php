<?php

namespace App\Http\Controllers\Admin\Trainings;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Trainings\StoreExternalTrainingRequest;
use App\Http\Requests\Trainings\UpdateExternalTrainingRequest;
use App\Http\Resources\Trainings\ExternalTrainingResource;
use App\Models\training\ExternalTraining;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExternalTrainingsController extends Controller
{
    use ResponseTrait;

    public function index(Request $request, ExternalTraining $externalTraining, PageRequest $pageRequest):JsonResponse
    {

        $externalTraining = ExternalTraining::filter($request, (array)$externalTraining->filterableColumns)->paginate($pageRequest->page_count);;
        return self::successResponsePaginate(data: ExternalTrainingResource::collection($externalTraining)->response()->getData(true));

    }

    public function show(ExternalTraining $externalTraining):JsonResponse
    {

        return self::successResponse(data: ExternalTrainingResource::make($externalTraining));
    }

    /**
     * @param StoreExternalTrainingRequest $request
     * @return JsonResponse
     */
    public function store(StoreExternalTrainingRequest $request):JsonResponse

    {
        $externalTrainingData = $request->safe()->except('attachments');
        $externalTraining = ExternalTraining::create($externalTrainingData);

        if ($request->attachments) {
            $externalTraining->assignAttachment($request->attachments);
        }

        return self::successResponse(__('application.added'), data: ExternalTrainingResource::make($externalTraining));
    }

    public function update(UpdateExternalTrainingRequest $request, ExternalTraining $externalTraining):JsonResponse
    {
        $externalTrainingData = $request->safe()->except('attachments');
        $externalTraining->update($externalTrainingData);

        if ($request->attachments) {
            $externalTraining->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'));
    }

    public function destroy(ExternalTraining $externalTraining):JsonResponse
    {
        $externalTraining->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

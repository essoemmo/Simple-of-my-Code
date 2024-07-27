<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\web\StoreAdvertisementRequest;
use App\Http\Requests\web\UpdateAdvertisementRequest;
use App\Http\Resources\web\AdvertisementsResource;
use App\Models\Web\Advertisement;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AdvertisementController extends Controller
{
    use ResponseTrait;

    public function index(Request $request,Advertisement $advertisement,PageRequest $pageRequest):JsonResponse
    {
        $advertisement = Advertisement::filter($request, (array)$advertisement->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: AdvertisementsResource::collection($advertisement)->response()->getData(true));
    }

    public function store(StoreAdvertisementRequest $request): JsonResponse
    {
        $advertisementData = $request->safe()->except('attachments');
        $advertisement = Advertisement::create($advertisementData);

        if ($request->attachments) {
            $advertisement->assignAttachment($request->attachments);
        }

        return self::successResponse(__('application.added'), data: AdvertisementsResource::make($advertisement));

    }

    public function show(Advertisement $advertisement):JsonResponse
    {
        return self::successResponse(data: AdvertisementsResource::make($advertisement));
    }


    public function update(UpdateAdvertisementRequest $request,  Advertisement $advertisement): JsonResponse
    {
        $AdvertisementData = $request->safe()->except('attachments');
        $advertisement->update($AdvertisementData);

        if ($request->attachments) {
            $advertisement->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.updated'),data: AdvertisementsResource::make($AdvertisementData));
    }

    public function destroy(Advertisement $advertisement):JsonResponse
    {
        $advertisement->delete();

        return self::successResponse(message: __('application.deleted'));
    }

}

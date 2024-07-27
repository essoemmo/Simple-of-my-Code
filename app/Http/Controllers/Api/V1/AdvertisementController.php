<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\ActiveEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\web\AdvertisementsResource;
use App\Models\Web\Advertisement;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AdvertisementController extends Controller
{
    use ResponseTrait;

    public function allAdvertisements():JsonResponse
    {
        $advertisement = Advertisement::where('status', ActiveEnum::active->value)->get();

        return self::successResponse(data: AdvertisementsResource::collection($advertisement));
    }
}

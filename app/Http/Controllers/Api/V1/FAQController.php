<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\FAQResource;
use App\Models\Web\FAQ;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class FAQController extends Controller
{
    use ResponseTrait;
    public function allFAQs():JsonResponse
    {
        $faqs = FAQ::all();

        return self::successResponse(data: FAQResource::collection($faqs));
    }
}

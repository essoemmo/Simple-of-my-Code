<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\StoreContactUsRequest;
use App\Http\Resources\Users\ContactUsResource;
use App\Models\Web\ContactUs;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactUsController extends Controller
{
    use ResponseTrait;

    public function store(StoreContactUsRequest $request): JsonResponse
    {
        ContactUs::create($request->validated());

        return self::successResponse(__('application.added'));
    }
}

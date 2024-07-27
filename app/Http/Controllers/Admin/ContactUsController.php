<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Resources\Users\ContactUsResource;
use App\Models\Web\ContactUs;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactUsController extends Controller
{
    use ResponseTrait;

    public function index(Request $request,ContactUs $contactUs,PageRequest $pageRequest): JsonResponse
    {

        $courses = ContactUs::filter($request, (array)$contactUs->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: ContactUsResource::collection($courses)->response()->getData(true));
    }
    public function destroy(ContactUs $contactUs): JsonResponse
    {
        $contactUs->delete();

        return self::successResponse(message: __('application.deleted'));
    }
}

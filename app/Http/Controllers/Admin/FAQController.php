<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\web\StoreFAQRequest;
use App\Http\Requests\web\UpdateFAQRequest;
use App\Http\Resources\Web\FAQResource;
use App\Models\Web\FAQ;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    use ResponseTrait;

    public function index(Request $request,FAQ $faq,PageRequest $pageRequest):JsonResponse
    {
        $faqs = FAQ::filter($request, (array)$faq->filterableColumns)->paginate($pageRequest->page_count);;

        return self::successResponsePaginate(data: FAQResource::collection($faqs)->response()->getData(true));
    }

    public function store(StoreFAQRequest $request)
    {
        $faq = FAQ::create($request->validated());

        return self::successResponse(message: __('application.added'), data: FAQResource::make($faq));
    }

    public function show(FAQ $faq)
    {
        return self::successResponse(data: FAQResource::make($faq));
    }

    public function update(UpdateFAQRequest $request, FAQ $faq)
    {
        $faq->update($request->validated());
        return self::successResponse(message: __('application.updated'), data: FAQResource::make($faq));
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return self::successResponse(message: __('application.deleted'));
    }
}

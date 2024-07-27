<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\Settings\StoreNationalityRequest;
use App\Http\Requests\Settings\UpdateNationalityRequest;
use App\Http\Resources\Settings\NationalityResource;
use App\Models\Settings\Nationality;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    use ResponseTrait;

    //TODO: list of nationalities

    /**
     * @param Request $request
     * @param Nationality $nationality
     * @param PageRequest $pageRequest
     * @return JsonResponse
     */
    public function index(Request $request, Nationality $nationality, PageRequest $pageRequest)
    {
        $nationalities = Nationality::filter($request, (array)$nationality->filterableColumns)->paginate($pageRequest->page_count);

        return self::successResponsePaginate(data: NationalityResource::collection($nationalities)->response()->getData(true));
    }

    //TODO: create new nationality
    /**
     * @param StoreNationalityRequest $request
     * @return JsonResponse
     */
    public function store(StoreNationalityRequest $request): JsonResponse
    {
        $nationalityData = $request->safe()->except('attachments');

        $nationality = Nationality::create($nationalityData);
        if ($request->attachments) {
            $nationality->assignAttachment($request->attachments);
        }

        return self::successResponse(message: __('application.added'),data: NationalityResource::make($nationality));
    }

//TODO: show specific nationality
    /**
     * @param Nationality $nationality
     * @return JsonResponse
     */
    public function show(Nationality $nationality)
    {
        return self::successResponse(data: NationalityResource::make($nationality));
    }

//TODO: update specific nationality
    /**
     * @param UpdateNationalityRequest $request
     * @param Nationality $nationality
     * @return JsonResponse
     */
    public function update(UpdateNationalityRequest $request, Nationality $nationality): JsonResponse
    {
        $nationality->update($request->validated());

        if ($request->attachments) {
            $nationality->assignAttachment($request->attachments);
        }
        return self::successResponse(message: __('application.updated'),data: NationalityResource::make($nationality));

    }

    //TODO: delete specific nationality
    /**
     * @param Nationality $nationality
     * @return JsonResponse
     */
    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return self::successResponse(message: __('application.deleted'));
    }
}

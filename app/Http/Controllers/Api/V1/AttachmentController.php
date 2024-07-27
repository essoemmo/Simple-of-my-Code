<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Options\FileTypesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UploadRequest;
use App\Http\Resources\Settings\FileResource;
use App\Traits\HasAttachmentTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AttachmentController extends Controller
{
    use HasAttachmentTrait;
    use ResponseTrait;

    public function __invoke(UploadRequest $request): JsonResponse
    {
        $method = 'save'.ucfirst($request->type).($request->type === FileTypesEnum::image->name && $request->has(
            'resize'
        ) ? 'Resize' : '');
        $file = self::$method(
            $request->type === FileTypesEnum::image->name ? $request->image : $request->file,
            $request->type.'s',
            $request->title,
            $request->name ?? null,
            $request->size ?? null,
            $request->id ?? null
        );

        return $this->successResponse(__('application.uploaded'), FileResource::make($file));
    }
}

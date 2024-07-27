<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'code' => (string)$this->code,
            'status' => $this->status?->label(),
            'attachments' => FileResource::collection($this->attachments()?->get()),

        ];
    }
}

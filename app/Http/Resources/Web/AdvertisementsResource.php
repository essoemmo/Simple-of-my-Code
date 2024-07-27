<?php

namespace App\Http\Resources\web;

use App\Http\Resources\Settings\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'status' => $this->status?->label(),
            'attachments' => FileResource::collection($this->attachments()?->get()),

        ];
    }
}

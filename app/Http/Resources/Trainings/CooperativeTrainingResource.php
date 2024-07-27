<?php

namespace App\Http\Resources\Trainings;

use App\Http\Resources\Settings\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CooperativeTrainingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->user?->name,
            'email' => (string) $this->user?->email,
            'phone' => (string) $this->user?->phone,
            'start_date' => (string) $this->start_date,
            'end_date' => (string) $this->end_date,
            'attachments' => FileResource::collection($this->user?->attachments),
        ];
    }
}

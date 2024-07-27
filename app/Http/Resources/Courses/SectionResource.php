<?php

namespace App\Http\Resources\Courses;

use App\Http\Resources\Settings\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'parent_id' => (int) $this->parent_id,
            'main_section' => (string) $this->section?->name,
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'status' => $this->status?->label(),
            'sub_sections' => SectionResource::collection($this->whenLoaded('sections')),
            'created_at' => (string) $this->created_at->format('Y-m-d'),
            'attachments' => FileResource::collection($this->attachments()?->get()),
        ];
    }
}

<?php

namespace App\Http\Resources\Courses;

use App\Http\Resources\Settings\FileResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'main_section_id' => (int)$this->main_section_id,
            'sub_section_id' => (int)$this->sub_section_id,
            'main_section_name' => $this->mainSection?->name,
            'sub_section_name' => $this->subSection?->name,
            'is_free' => (int)$this->is_free,
            'price' => (double)$this->price,
            'discount_price' => (double)$this->discount_price,
            'name' => (string)$this->name,
            'intro_video_url' => (string)$this->intro_video_url,
            'description' => (string)$this->description,
            'requirements' => (string)$this->requirements,
            'location' => (string)$this->location,
            'duration' => (string)$this->duration,
            'keywords' => (string)$this->keywords,
            'meta_description' => (string)$this->meta_description,
            'meta_tags' => (string)$this->meta_tags,
            'video_hosting' => $this->video_hosting->label(),
            'level' => $this->level?->label(),
            'type' => $this->type?->label(),
            'language' => $this->language?->label(),
            'status' => $this->status?->label(),
            'attachments' => FileResource::collection($this->whenLoaded('attachments')),
            'chapters' => ChapterResource::collection($this->whenLoaded('chapters')),
            'instructor' => UserResource::collection($this->whenLoaded('instructor')),
        ];
    }
}

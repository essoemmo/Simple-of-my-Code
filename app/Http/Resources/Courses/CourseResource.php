<?php

namespace App\Http\Resources\Courses;

use App\Http\Resources\Settings\FileResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'main_section_id' => (int) $this->main_section_id,
            'sub_section_id' => (int) $this->sub_section_id,
            'main_section_name' => $this->mainSection?->name,
            'sub_section_name' => $this->subSection?->name,
            'instructor' =>$this->instructor?->name,
            'name' => (string) $this->name,
           // 'video_hosting' => (int) $this->video_hosting,
            'intro_video_url' => (string) $this->intro_video_url,
            'description' => (string) $this->description,
            'requirements' => (string) $this->requirements,
            'type' => $this->type?->label(),
            'language' => $this->language?->label(),
            'location' => (string) $this->location,
            'is_free' => (boolean) $this->is_free,
            'price' => (double) $this->price,
            'discount_price' => (double) $this->discount_price,
            'level' => $this->level?->label(),
            'duration' => (string) $this->duration,
            'keywords' => (string) $this->keywords,
            'meta_description' => (string) $this->meta_description,
            'meta_tags' => (string) $this->meta_tags,
            'status' => $this->status?->label(),
            'created_at' => (string) $this->created_at->format('Y-m-d'),
            'attachments' => FileResource::collection($this->attachments()?->get()),
        ];
    }
}

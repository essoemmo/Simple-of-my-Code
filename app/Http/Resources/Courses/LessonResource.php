<?php

namespace App\Http\Resources\Courses;

use App\Http\Resources\Settings\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'course_id' => (int)$this->course_id,
            'course_name' => (string)$this->course?->name,
            'chapter_id' => (int)$this->chapter_id,
            'chapter_name' => (string)$this->chapter?->name,
            'name' => (string)$this->name,
            'video_hosting' => $this->video_hosting,
            'video_url' => (string)$this->video_url,
            'video_file' => (string)$this->video_file,
            'description' => (string)$this->description,
            'status' => $this->status?->label(),
            'created_at' => (string) $this->created_at->format('Y-m-d'),
            'attachments' => FileResource::collection($this->attachments()?->get()),
        ];
    }
}

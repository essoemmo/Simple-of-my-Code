<?php

namespace App\Http\Resources\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'name' => (string) $this->name,
            'status' => $this->status?->label(),
            'created_at' => (string) $this->created_at->format('Y-m-d'),
        ];
    }
}

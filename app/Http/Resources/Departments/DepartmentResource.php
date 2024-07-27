<?php

namespace App\Http\Resources\Departments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'parent_id' => (int) $this->parent_id,
            'main_department' => (string) $this->department?->name,
            'name' => (string) $this->name,
            'description' => (string) $this->description,
            'available_seats' => (int) $this->available_seats,
            'status' => $this->status?->label(),
            'created_at' => (string) $this->created_at->format('Y-m-d'),
            'sub_departments' => DepartmentResource::collection($this->whenLoaded('departments')),
        ];
    }
}

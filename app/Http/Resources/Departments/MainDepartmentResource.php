<?php

namespace App\Http\Resources\Departments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainDepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>(int) $this->id,
            'title' => (string) $this->name,
        ];
    }
}

<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseLevelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->value,
            'title' => (string) $this->label(),
        ];
    }
}

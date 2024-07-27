<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reviewable_id' => (integer) $this->reviewable_id,
            'stars' => (integer) $this->stars,
            'comment' => (string) $this->comment,
        ];
    }
}

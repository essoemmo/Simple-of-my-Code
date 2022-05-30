<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->users->name,
            'image'  => getImagePath($this->users->image),
            'date'   => $this->created_at->format('d M Y'),
            'stars'  => $this->stars,
            'review' => $this->review,
        ];
    }
}

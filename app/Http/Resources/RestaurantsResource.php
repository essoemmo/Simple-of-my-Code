<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantsResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'address'   => $this->address,
            'lat'       => $this->lat,
            'lang'      => $this->lang,
            'image'     => getImagePath($this->image),
            'distance'  => round($this->distance),
            'visits'    => round($this->orders()->where('order_status_id',6)->count()),
            'full_rate' => round($this->rates->avg('stars')),
        ];
    }
}

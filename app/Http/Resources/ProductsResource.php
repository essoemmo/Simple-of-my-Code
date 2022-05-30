<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'id'         => $this->id,
            'title'      => $this->title,
            'short_desc' => $this->short_desc,
            'image'      => getImagePath($this->image),
            'main_price' => round($this->main_price,2) ? round($this->main_price,2) : __('application.choise'),
        ];
    }
}

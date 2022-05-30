<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'title'      => $this->products->title,
            'short_desc' => $this->products->short_desc,
            'image'      => getImagePath($this->products->image),
            'price'      => $this->types ? round($this->types->price,2) : round($this->products->main_price,2),
            'qty'        => $this->qty,
        ];
    }
}

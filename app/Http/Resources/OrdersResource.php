<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
            'id' => $this->id,
            'kid' => $this->kid->name,
            'seller' => $this->seller->name,
            'total' => $this->total,
            'date' => $this->created_at->format('d-m-Y'),
            'time' => $this->created_at->format('H:i'),
            'products' => ProductResource::collection($this->products),

        ];
    }
}

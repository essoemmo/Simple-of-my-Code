<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RechargeResource extends JsonResource
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
            'parent'    => $this->user->name,
            'kid'       => $this->kid->name,
            'image'     => getImagePath($this->kid->image),
            'amount'    => $this->amount,
            'date'      => $this->created_at->format('d-m-Y')
        ];
    }
}

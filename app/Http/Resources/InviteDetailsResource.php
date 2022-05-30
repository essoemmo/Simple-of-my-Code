<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InviteDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'               => $this->id,
            'restaurant_id'    => $this->reservations->restaurant_id,
            'restaurant_name'  => $this->reservations->restaurants->name,
            'user_name'        => $this->reservations->users->name,
            'date'             => Carbon::parse($this->reservations->date)->format('d M Y'),
            'time'             => Carbon::parse($this->reservations->time)->format('H:i a'),
            'products'         => $this->users->orders()->count() ? OrderProductsResource::collection($this->users->orders()->where('user_id',$this->users->id)->first()->products) : [],
        ];
    }
}

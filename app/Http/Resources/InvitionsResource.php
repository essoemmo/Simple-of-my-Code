<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitionsResource extends JsonResource
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
           'id'               => $this->id,
           'status'           => $this->status,
           'reservation_id'   => $this->reservation_id,
           'restaurant_id'    => $this->reservations->restaurant_id,
           'image'            => getImagePath($this->reservations->restaurants->image),
           'restaurant_name'  => $this->reservations->restaurants->name,
           'user_name'        => $this->reservations->users->name,
           'date'             => Carbon::parse($this->reservations->date)->format('d M Y'),
           'time'             => Carbon::parse($this->reservations->time)->format('H:i a'),
           'order_time'       => $this->reservations->created_at->format('H:i a'),
        ];
    }
}

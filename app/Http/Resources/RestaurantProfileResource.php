<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantProfileResource extends JsonResource
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
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'image'   => getImagePath($this->image),
            'cover'   => getImagePath($this->cover),
            'from'    => $this->from,
            'to'      => $this->to,
            'resrv_numb' => $this->resrv_numb,
            'lat'     => $this->lat,
            'lang'    => $this->lang,
            'address' => $this->address,
            'qr_code' => getImagePath('/images/'.$this->id.'.png'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = auth('api')->user();
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'phone'      => $this->phone,
            'lat'        => $this->lat,
            'lang'       => $this->lang,
            'from'       => date("g:i a", strtotime($this->from)),
            'to'         => date("g:i a", strtotime($this->to)),
            'image'      => getImagePath($this->image),
            'cover'      => getImagePath($this->cover),
            'address'    => $this->address,
            'distance'   => $user ? KmDistance($user->lang,$this->lang,$user->lat,$this->lat) : 0,
            'visits'     => round($this->orders()->where('order_status_id',6)->count()),
            'full_rate'  => round($this->rates->avg('stars')),
            'users_numb' => $this->rates->count('user_id'),
            'categories' => CategoryResource::collection($this->categories),
            'photos'     => PhotosResource::collection($this->photos),
            'rates'      => RatesResource::collection($this->rates),
            'amenities'  => AmenityResource::collection($this->amenities),
            'qr_code'    => getImagePath('/images/'.$this->id.'.png'),
        ];
    }
}

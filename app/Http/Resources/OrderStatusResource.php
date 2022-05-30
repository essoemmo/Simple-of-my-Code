<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($request->type_id != 2)
            $orders = OrdersResource::collection($this->orders()
            ->where('order_type_id',$request->type_id)
            ->where('restaurant_id',auth('restaurant-api')->user()->id)->latest()->get());
        else
            $orders = ResrvationRestaurantResource::collection($this->reservations()
            ->where('restaurant_id',auth('restaurant-api')->user()->id)->latest()->get());

        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'orders' => $orders
        ];

    }
}

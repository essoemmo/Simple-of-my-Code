<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->id != 2)
            $orders = OrdersResource::collection($this->orders()
            ->when(request()->routeIs('activeorders'),function($query)
            {
                return $query->whereIn('order_status_id',[1,2,3]);

            })->when(request()->routeIs('historyorders'),function($query)
            {
                return $query->whereIn('order_status_id',[4,5,6]);

            })->where('user_id',auth()->user()->id)->latest()->get());
        else
            $orders = ReservationsResource::collection(Reservation::
            when(request()->routeIs('activeorders'),function($query)
            {
                return $query->whereIn('order_status_id',[1,2,3]);

            })->when(request()->routeIs('historyorders'),function($query)
            {
                return $query->whereIn('order_status_id',[4,5,6]);

            })->where('user_id' , auth()->user()->id)->latest()->get());

        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'orders' => $orders
        ];
        
    }
}

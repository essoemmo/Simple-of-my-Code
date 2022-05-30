<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order = $this->orders()->where('user_id',auth()->user()->id)->first();
        if ($this->orders()->where('user_id',auth()->user()->id)->first()) {
            $products = OrderProductsResource::collection($this->orders()->where('user_id',auth()->user()->id)->first()->products);
        }else{
            $products = [];
        }
        return [
            'id'          => $this->id,
            'restaurant_id' => $this->restaurants->id,
            'image'       => getImagePath($this->restaurants->image),
            'name'        => $this->restaurants->name,
            'date'        => Carbon::parse($this->date)->format('d M Y'),
            'time'        => Carbon::parse($this->time)->format('H:i a'),
            'status'      => $this->status->title,
            'user_name'   => $this->users->name,
            'phone'       => $this->users->phone,
            'sets'        => $this->sets,
            'note'        => $this->note,
            'type_place'  => $this->typeplaces->title,
            'order_date'  => $this->created_at->format('d M Y'),
            'order_time'  => $this->created_at->format('H:i a'),
            'products'    => $products,
            'unfor_date'  => $this->created_at->format('Y-m-d'),
            'sub_total'   => $order ? $order->sub_total : 0,
            'discount'    => $order ? round($order->discount) : 0,
            'total'       => $order ? $order->total : 0,
            //'invitetions' => InviteResource::collection($this->invitions),
          ];
    }
}

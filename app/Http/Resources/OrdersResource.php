<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
       // dd($this->types->title);
       return [
            'id'         => $this->id,
            'restaurant_id'  => $this->restaurants->id,
            'status'     => $this->status->title,
            'user_name'  => $this->users->name,
            'phone'      => $this->users->phone,
            'image'      => getImagePath($this->restaurants->image),
            'name'       => $this->restaurants->name,
            'date'       => Carbon::parse($this->date)->format('d M Y') ? Carbon::parse($this->date)->format('d M Y') : null,
            'time'       => Carbon::parse($this->time)->format('H:i a') ? Carbon::parse($this->time)->format('H:i a') : null,
            'sets'       => null,
            'note'       => $this->note,
            'type_place' => $this->typeplaces ? $this->typeplaces->title : null,
           // 'order_type' => $this->types->title,
            'order_date' => $this->created_at->format('d M Y'),
            'order_time' => $this->created_at->format('H:i a'),
            'products'   => OrderProductsResource::collection($this->products),
            'sub_total'  => $this->sub_total,
            'discount'   => round($this->discount),
            'total'      => $this->total,
            'unfor_date' => $this->created_at->format('Y-m-d'),
        ];

    }


}

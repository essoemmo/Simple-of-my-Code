<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ResrvationRestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products= array();
        foreach ($this->orders as $order) {
            foreach ($order->products as  $product) {
                $products [] = $product;
            }
        } 

        return [
            'id'          => $this->id,
            'image'       => getImagePath($this->restaurants->image),
            'name'        => $this->restaurants->name,
            'date'        => Carbon::parse($this->date)->format('d M Y'),
            'time'        => Carbon::parse($this->time)->format('H:i a'),
            'sets'        => $this->sets,
            'note'        => $this->note,
            'user_name'   => $this->users->name,
            'phone'       => $this->users->phone,
            'type_place'  => $this->typeplaces->title,
            'order_date'  => $this->created_at->format('d M Y'),
            'order_time'  => $this->created_at->format('H:i a'),
            'status'      => $this->status->title,
            'products'    => OrderProductsResource::collection($products),
            'unfor_date'  => $this->created_at->format('Y-m-d'),
            'sub_total'   => $this->orders->sum('sub_total'),
            'discount'    => round($this->orders->sum('discount')),
            'total'       => $this->orders->sum('total'),
            'invitetions' => $this->invitions ? InviteResource::collection($this->invitions) : [],
          ];
    }
    
}

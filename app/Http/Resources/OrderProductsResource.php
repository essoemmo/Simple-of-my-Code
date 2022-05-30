<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class OrderProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data= new stdClass();
        $data->id = null;
        $data->title = null;
        $data->price = $this->main_price;
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => getImagePath($this->image),
            'qty'         => $this->pivot->qty,
            'types'       => $this->pivot->type_id ? TypeResource::make($this->types()->where('id',$this->pivot->type_id)->first()) : $data,
        ];
    }
}

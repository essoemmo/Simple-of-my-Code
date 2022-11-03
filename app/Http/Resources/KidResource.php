<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KidResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type->title,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'id_number' => $this->id_number,
            'city' => $this->city == null ? null : $this->city->title,
            'nationality' => $this->national == null ? null : $this->national->title,
            'image' => getImagePath($this->image),
            'fatherName'=> $this->user ? $this->user->name : "",
            'fatherEmail'=> $this->user?$this->user->email:"",
            'fatherPhone'=> $this->user?$this->user->phone:"",
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'title'     => $this->title,
            'logo'      => $this->logo,
            'facebook'  => $this->facebook,
            'instagram' => $this->instagram,
            'twitter'   => $this->twitter,
            'linkedin'  => $this->linkedin,
            'phone'     => $this->phone,
            'whatsapp'  => $this->whatsapp,
            'website'   => $this->website,
            'email'     => $this->email,
            'address'   => $this->address,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => $this->type_id,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'id_number' => $this->id_number,
            'code' => $this->code,
            'owner_name'=>$this->manager_name,
            'owner_phone'=>$this->manager_phone,
            'is_verified' => (int)$this->is_verified,
            'is_active' => (int)$this->active,
            'relation' => $this->relation == null ? null : $this->relation->title,
            'city' => $this->city == null ? null : $this->city->title,
            'nationalty' => $this->national == null ? null : $this->national->title,
            'organization' =>  $this->user ? $this->user->name :"",
            'national_address' => $this->national_address,
            'parent' =>  $this->user_id ? $this->parent->name : null ,
            'blood_type' =>  $this->blood_type,
            'balance' =>  $this->balance,
            'gender' =>  $this->sex?->{'title_'.app()->getLocale()},
            'language' =>  $this->language?->{'title_'.app()->getLocale()},
            'kid_description' =>  $this->description,
            'image' => getImagePath($this->image),
            'access_token' => $this->createToken('PersonalAccessToken')->plainTextToken,
            'google_token' => $this->google_token,
        ];
    }
}

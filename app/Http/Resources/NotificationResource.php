<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon as SupportCarbon;

class NotificationResource extends JsonResource
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
            'id'        => $this->id,
            'title'     => $this->data['title_'. app()->getLocale()],
            'body'      => $this->data['body_' . app()->getLocale()],
            'time'      => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'email' => (string)$this->email,
            'phone' => (string)$this->phone,
            'message_type' => $this->message_type?->label(),
            'message' => (string)$this->message,
        ];
    }
}

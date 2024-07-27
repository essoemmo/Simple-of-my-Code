<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Settings\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'name' => (string)$this->name,
            'phone' => (string)$this->phone,
            'email' => (string)$this->email,
            'status' => $this->status?->label() ?? '',
            'type' => $this->type?->label() ?? '',
            'id_number' => (int)$this->userDetail?->id_number,
            'department_id' => (int)$this->department_id,
            'gender' => (string)$this->userDetail?->gender?->label(),
            'qualifications' => (string)$this->userDetail?->qualifications,
            'age' => (int)$this->userDetail?->age,
            'description' => (string)$this->userDetail?->description,
            'access_token' => (string)$this->access_token,
            'employee_number' => (int)$this->userDetail?->employee_number,
            'birth_date' => convert_date($this?->userDetail?->birth_date),
            'job_type' => (string)$this->userDetail?->job_type,
            'address' => (string)$this->userDetail?->address,
            'nationality' => (string)$this->nationality?->name,
            'date_sent' => convert_date($this->created_at),
            'code' => (int)$this->code,
            'profile_id' => (int) $this->attachments()->where('title', 'profile')->first()?->id,
            'profile' => $this->getAttachmentFile('profile'),
            'attachments' => FileResource::collection($this->attachments),

        ];
    }
}

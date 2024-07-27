<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Settings\FileResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{


    // Add a constructor to accept the token
    public function __construct($resource, protected $token = null)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'department_id' => (int)$this->department_id,
            'nationality_id' => (int)$this->nationality_id,
            'role_id' => (int)$this->roles()->first()?->id,
            'is_verified' => (int) $this->is_verified,
            'is_active' => (int) $this->is_active,
            'department_name' => (string)$this->department?->name,
            'nationality_name' => (string)$this->nationality?->name,
            'role_name' => (string)$this->roles()->first()?->name,
            'name' => (string)$this->name,
            'email' => (string)$this->email,
            'phone' => (string)$this->phone,
            'address' => (string)$this->address,
            'description' => (string)$this->description,
            'qualifications' => (string)$this->qualifications,
            'access_token' => (string) $this->access_token,
            'whatsapp' => (string)$this->whatsapp,
            'id_number' => (int)$this->id_number,
            'salary' => (double)$this->salary,
            'refuse_reason' => (string)$this->refuse_reason,
            'age' => (int)$this->age,
            'employee_number' => (int)$this->employee_number,
            'gender' => $this->gender?->label(),
            'status' => $this->status?->label(),
            'job_type' => $this->job_type?->label(),
            'birth_date' => convert_date($this->birth_date),
            'join_date' => convert_date($this->join_date),
            'date_sent' => convert_date($this->created_at),
            'code' => (string) $this->code,
            'attachments' => FileResource::collection($this->attachments),
        ];
    }
}

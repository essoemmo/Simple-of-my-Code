<?php

namespace App\Http\Resources\Trainings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Settings\FileResource;

class ExternalTrainingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'user_name' => (string)$this->user?->name,
            'department_id' => (int)$this->department?->name,
            'course_name' => (string)$this->course_name,
            'training_type' => $this->training_type?->label(),
            'status' => $this->status?->label(),
            'start_date' => Carbon::parse($this->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($this->end_date)->format('Y-m-d'),
            'days' => (int)$this->days,
            'time' => (string)$this->time,
            'location' => (string)$this->location,
            'training_benefit' => (string)$this->training_benefit,
            'skills_training' => (string)$this->skills_training,
            'attachments' => FileResource::collection($this->attachments()?->get()),

        ];
    }
}

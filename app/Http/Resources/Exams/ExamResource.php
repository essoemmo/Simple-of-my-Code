<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'name_ar' => (string)$this->name_ar,
            'name_en' => (string)$this->name_en,
            'chapter_id' => (int)$this->chapter_id,
            'instructions' => (string)$this->instructions,
            'min_passing_grade' => (int)$this->min_passing_grade,
            'random_questions' => (int)$this->random_questions,
            'num_random_questions' => (int)$this->num_random_questions,
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
            'status' => $this->status?->label(),
        ];
    }
}

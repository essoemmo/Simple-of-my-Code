<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'question_id' => (int) $this->question_id,
            'answer_text' => (string) $this->answer_text,
            'is_correct' => (bool) $this->is_correct,
        ];
    }
}

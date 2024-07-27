<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'exam_id' => (int) $this->exam_id,
            'question_type' => $this->question_type?->label(),
            'question_text' => (string) $this->question_text,
             'answer_text' => (string) $this->answer_text,
            'explanation' => (string) $this->explanation,
            'correct_order' => (int) $this->correct_order,
        ];
    }
}

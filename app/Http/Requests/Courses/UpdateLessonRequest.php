<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UpdateLessonRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'chapter_id' => ['nullable', 'integer', 'exists:chapters,id'],
            'course_id' => ['nullable', 'integer', 'exists:courses,id'],
            'name_ar' => ['nullable', 'string', 'max:255', Rule::unique('lessons')->ignore($this->lesson->id)->whereNull('deleted_at')],
            'name_en' => ['nullable', 'string', 'max:255',Rule::unique('lessons')->ignore($this->lesson->id)->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'video_hosting' => ['nullable', 'integer'],
            'video_url' => ['nullable', 'string', 'url'],
            'description_ar' => ['nullable', 'min:10', 'max:255', 'string'],
            'description_en' => ['nullable', 'min:10', 'max:255', 'string', 'regex:/[a-zA-Z]/'],
            'status' => ['nullable', 'integer'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

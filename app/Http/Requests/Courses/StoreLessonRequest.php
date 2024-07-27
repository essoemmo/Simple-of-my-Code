<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreLessonRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'chapter_id' => ['required', 'integer', 'exists:chapters,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'name_ar' => ['required', 'string', 'max:255',Rule::unique('lessons','name_ar')->whereNull('deleted_at'),],
            'name_en' => ['required', 'string', 'max:255',Rule::unique('lessons','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'video_hosting' => ['required', 'integer'],
            'video_url' => ['nullable', 'string', 'url'],
            'description_ar' => ['nullable', 'min:10', 'max:255', 'string'],
            'description_en' => ['nullable', 'min:10', 'max:255', 'string', 'regex:/[a-zA-Z]/'],
            'status' => ['required', 'integer'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

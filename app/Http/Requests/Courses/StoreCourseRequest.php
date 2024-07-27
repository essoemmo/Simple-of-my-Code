<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'main_section_id' => ['required', 'integer', 'exists:sections,id'],
            'sub_section_id' => ['required', 'integer', 'exists:sections,id'],
            'instructor_id' => ['nullable', 'integer', 'exists:users,id'],
            'name_ar' => ['required', 'string', 'max:255',Rule::unique('courses','name_ar')->whereNull('deleted_at')],
            'name_en' => ['required', 'string', 'max:255',Rule::unique('courses','name_en')->whereNull('deleted_at'),'regex:/[a-zA-Z]/'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'video_hosting' => ['required', 'integer'],
            'intro_video_url' => ['nullable', 'string', 'url'],
            'requirements_ar' => ['nullable', 'string'],
            'requirements_en' => ['nullable', 'string'],
            'type' => ['required', 'integer'],
            'language' => ['required', 'integer'],
            'location' => ['nullable', 'integer'],
            'is_free' => ['required', 'boolean'],
            'price' => ['nullable', 'numeric'],
            'discount_price' => ['nullable', 'numeric'],
            'level' => ['required', 'integer'],
            'duration_ar' => ['nullable', 'string'],
            'duration_en' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            'meta_tags' => ['nullable', 'string'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

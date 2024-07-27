<?php

namespace App\Http\Requests\Courses;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'main_section_id' => ['integer', 'exists:sections,id'],
            'sub_section_id' => ['integer', 'exists:sections,id'],
            'instructor_id' => ['integer', 'exists:users,id'],
            'name_ar' => ['string', 'max:255',Rule::unique('courses','name_ar')->whereNull('deleted_at')],
            'name_en' => ['string', 'max:255',Rule::unique('courses','name_en')->whereNull('deleted_at'), 'regex:/[a-zA-Z]/'],
            'description_ar' => ['string'],
            'description_en' => ['string'],
            'video_hosting' => ['integer'],
            'intro_video_url' => ['nullable', 'string'],
            'intro_video_file' => ['nullable', 'string'],
            'requirements_ar' => ['nullable', 'string'],
            'requirements_en' => ['nullable', 'string'],
            'type' => ['integer'],
            'language' => ['integer'],
            'location' => ['nullable', 'integer'],
            'is_free' => ['boolean'],
            'price' => ['nullable', 'numeric'],
            'discount_price' => ['nullable', 'numeric'],
            'level' => ['integer'],
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

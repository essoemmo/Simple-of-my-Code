<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\ApiFormRequest;

class UploadRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer', 'exists:attachments,id'],
            'title' => ['required', 'string', 'max:55'],
            'name' => ['nullable', 'string', 'max:55'],
            'size' => ['required', 'integer'],
            'type' => ['required', 'string', 'in:image,file'],
            'resize' => ['nullable', 'boolean'],
            'image' => ['required_if:type,image', 'mimes:png,jpg,jpeg,webp,heic', 'max:5240'],
            'file' => ['required_if:type,file', 'mimes:pdf,doc,docx,txt', 'max:5240'],
        ];
    }
}

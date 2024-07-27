<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name'=>['nullable','string'],
            'status' => ['nullable', 'integer'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

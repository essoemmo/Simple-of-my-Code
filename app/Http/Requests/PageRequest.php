<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends ApiFormRequest
{


    public function rules(): array
    {
        return [
            'page_count' => ['required', 'integer', 'min:1', 'max:40'],
        ];
    }
}

<?php

namespace App\Http\Requests\web;

use App\Http\Requests\ApiFormRequest;


class StoreAdvertisementRequest extends ApiFormRequest
{

    public function rules(): array
    {
        return [
            'name'=>['required','string'],
            'status' => ['required', 'integer'],
            'attachments' => ['required','array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

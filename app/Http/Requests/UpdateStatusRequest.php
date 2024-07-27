<?php

namespace App\Http\Requests;

class UpdateStatusRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'model_name'=>['required','string'],
            'model_id'=>['required','integer'],
            'status'=>['required','integer','between:1,10'],
        ];
    }
}

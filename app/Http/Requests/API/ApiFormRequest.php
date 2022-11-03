<?php

namespace App\Http\Requests\API;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiFormRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if user authorized to make this request
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    abstract public function rules();

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator) : HttpResponseException
    {
        throw new HttpResponseException(
           $this->faildResponse(422,$validator->errors()->first())
        );
    }
}
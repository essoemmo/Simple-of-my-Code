<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AddCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'restaurant_id'  => ['required','exists:restaurants,id'],
            'product_id'     => ['required',Rule::exists('products','id')->where(function ($query) {
                return $query->where('restaurant_id', $this->restaurant_id);
            })],
            'type_id'        => [Rule::exists('types','id')->where(function ($query) {
                return $query->where('product_id', $this->product_id);
            })],
            'qty'            => ['required', 'numeric'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if (request()->is('api/*')) {
            $errors = $validator->errors();
            throw new HttpResponseException(response()->json([
                    'success' => 0,
                    'message' => $validator->errors()->first()
                ]
                , JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        } else {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}

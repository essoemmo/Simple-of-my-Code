<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class RegRestaurantRequest extends FormRequest
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
            'name'         => ['required','string'],
            'phone'        => ['required','string','unique:restaurants'],
            'email'        => ['required','string','email','unique:restaurants'],
            'lat'          => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lang'         => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'address'      => ['required','string'],
            'from'         => ['required','string'],
            'to'           => ['required','string'],
            'password'     => ['required','string','min:8','confirmed'],
            'google_token' => ['required'],
            'image'        => ['required','mimes:png,jpg'],
            'cover'        => ['required','mimes:png,jpg'],
            //'type_place_id' => ['required','exists:type_places,id'],
            'res_ber_hour' => ['required','numeric'],
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
        if (request()->is('restaurant/*')) {
            $errors = $validator->errors();
            throw new HttpResponseException(response()->json([
                    'success' => 0,
                    'message' => $validator->errors()->first()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        } else {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}

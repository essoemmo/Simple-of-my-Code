<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
class UpdateRestaurantRequest extends FormRequest
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
            'name'         => ['string'],
            'phone'        => ['string', Rule::unique('restaurants')->
                         ignore(auth('restaurant-api')->user()->id)],
            'email'        => ['string','email', Rule::unique('restaurants')->
                         ignore(auth('restaurant-api')->user()->id)],
            'lat'          => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lang'         => ['regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'address'      => ['string'],
            'image'        => ['mimes:png,jpg'],
            'cover'        => ['mimes:png,jpg'],
            'from'         => ['string'],
            'to'           => ['string'],
            'type_place_id'   => ['exists:type_places,id'],
            'res_ber_hour' => ['numeric']
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

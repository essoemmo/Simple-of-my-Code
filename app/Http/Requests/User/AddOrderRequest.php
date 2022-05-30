<?php

namespace App\Http\Requests\User;

use App\Rules\TimeBetweenRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AddOrderRequest extends FormRequest
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
            'restaurant_id'   => ['required','exists:restaurants,id'],
            'reservation_id'  => ['exists:reservations,id'],
            'date'            => ['date_format:Y-m-d'],
            'time'            => [new TimeBetweenRule($this->restaurant_id)],
            'type_place_id'   => ['exists:type_places,id'],
            'note'            => ['string','max:255'],
            'table_number'    => ['integer','min:1'],
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
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        } else {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}

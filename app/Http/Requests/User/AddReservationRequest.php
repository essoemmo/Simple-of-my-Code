<?php

namespace App\Http\Requests\User;

use App\Rules\ReservRule;
use App\Rules\TimeBetweenRule;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AddReservationRequest extends FormRequest
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
            'sets'            => ['required','numeric'],
            'date'            => ['required','date_format:Y-m-d','after_or_equal:'.Carbon::now()->format('Y-m-d')],
            'time'            => ['required', new ReservRule($this->restaurant_id) ,new TimeBetweenRule($this->restaurant_id)],
            'note'            => ['string'],
            'type_place_id'   => ['required','exists:type_places,id'],
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

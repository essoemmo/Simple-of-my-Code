<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCoupon extends FormRequest
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
            'code' =>['required',Rule::unique('coupons')->ignore($this->coupon)],
            'from' =>['required','date'],
            'to' =>['required','date'],
            'precent' =>['required','numeric'],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        $user = User::findOrFail($this->user);
        return [
            'name'    => ['required','string'],
            'phone'   => ['string', Rule::unique('users')->ignore($user->id)],
            'email'   => ['string','email', Rule::unique('users')->ignore($user->id)],
            'address' => ['required','string'],
            'image'   => ['nullable','image','mimes:jpeg,jpg,png,gif'],
        ];
    }
}

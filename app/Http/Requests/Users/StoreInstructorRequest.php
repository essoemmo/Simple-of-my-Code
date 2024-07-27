<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreInstructorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'phone' => ['required','string','digits:9','max:255',Rule::unique('users','phone')->whereNull('deleted_at')],
            'email' => ['required','string','email','max:255',Rule::unique('users','email')->whereNull('deleted_at')],
            'password' => ['required','string','min:8','confirmed'],
            'id_number' => ['required','integer','digits:10',Rule::unique('user_details','id_number')->whereNull('deleted_at')],
            'gender' => ['required','boolean'],
            'qualifications' => ['required','string'],
            'birth_date' => ['required','date_format:Y-m-d'],
            'age' => ['required','integer'],
            'description' => ['required','string'],
            'nationality_id' => ['required','integer','exists:nationalities,id'],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],
        ];
    }
}

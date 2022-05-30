<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaq extends FormRequest
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
            'answer_ar'   =>['string','max:255'],
            'answer_en'   =>['string','max:255'],
            'question_ar' =>['string','max:255'],
            'question_en' =>['string','max:255'],
        ];
    }
}

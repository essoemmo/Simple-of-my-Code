<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'stars' => ['required', 'numeric'],
            'comment' => ['required','string','max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

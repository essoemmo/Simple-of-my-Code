<?php

namespace App\Rules;

use App\Models\Restaurant;
use Illuminate\Contracts\Validation\Rule;

class TimeBetweenRule implements Rule
{

    private $restaurant_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($rest)
    {
        $this->restaurant_id = $rest;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rest = Restaurant::find($this->restaurant_id);
        $time = date("H:i", strtotime("$value"));
        if ($rest->from < $rest->to) {
            if ($time >= $rest->from && $time <= $rest->to) {
                return true;
            }
        }else{
            if ($time >= $rest->from || $time <= $rest->to) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('application.resttime');
    }
}

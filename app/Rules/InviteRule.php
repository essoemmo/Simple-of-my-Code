<?php

namespace App\Rules;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class InviteRule implements Rule
{

    private $reservation_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation_id = $reservation;
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
        $reservation =  Reservation::findOrFail($this->reservation_id);
        $reservs = $reservation->invitions()->count();
        if ($reservs >= ($reservation->sets - 1)) {
            return false;
        }
       return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('application.limitinvite');
    }
}

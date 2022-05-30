<?php

namespace App\Rules;

use App\Models\Reservation;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ReservRule implements Rule
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
        $rest = Restaurant::findOrFail($this->restaurant_id);
        $time = date("H", strtotime("$value"));

        $datetime = request()->date;
        $hour_reserv = Carbon::parse($datetime)->addHour($time);
        $add_hour_reserv = Carbon::parse($hour_reserv)->addHour();

        $reserv = Reservation::where('date', $datetime)
        ->where('restaurant_id',$this->restaurant_id)
        ->whereBetween('time',[$hour_reserv,$add_hour_reserv])->count();

         if ($reserv >= $rest->resrv_numb) {
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
        return __('application.completereserv');
    }
}

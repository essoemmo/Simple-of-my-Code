<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => rand(1,4),
            'user_id'  => rand(1,4),
            'stars'  => rand(1,4),
            'review'=> $this->faker->word(),
        ];
    }
}

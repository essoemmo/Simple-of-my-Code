<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => 1,
            'title_ar' => $this->faker->word(),
            'title_en' => $this->faker->word(),
            'price' => rand(20,100),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Privecy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrivecyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Privecy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description_ar' => $this->faker->paragraph(),
            'description_en' => $this->faker->paragraph(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{

   /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => rand(1,4),
            'title_ar' => $this->faker->word(),
            'title_en' => $this->faker->word(),
            'image' => 'default.png',
            'active' => 1,
        ];
    }
}

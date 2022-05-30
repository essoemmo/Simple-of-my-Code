<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => 1,
            'category_id'  => 1,
            'title_ar'=> $this->faker->word(),
            'title_en'=> $this->faker->word(),
            'short_desc_ar'=> $this->faker->catchPhrase,
            'short_desc_en'=> $this->faker->catchPhrase,
            'description_ar' => $this->faker->paragraph(),
            'description_en' => $this->faker->paragraph(),
            'active' => 1
        ];
    }
}

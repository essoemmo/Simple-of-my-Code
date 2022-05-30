<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_ar' => $this->faker->catchPhrase,
            'question_en' => $this->faker->catchPhrase,
            'answer_en' => $this->faker->paragraph(),
            'answer_ar' => $this->faker->paragraph(),
        ];
    }
}
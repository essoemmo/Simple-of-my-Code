<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'isVerified' => 1,
            'code' => mt_rand(1000, 9999),
            'active' => true,
            'email' => $this->faker->unique()->safeEmail(),
            'lat' => 31.09101,
            'lang' => 31.5945454,
            'address' => 'geda',
            'image' => 'default.png',
            'cover' => 'default.png',
            'password' => Hash::make('12345678'),
            'from' => $this->faker->time(),
            'to' => $this->faker->time(),
            'resrv_numb' => 3,
        ];
    }
}

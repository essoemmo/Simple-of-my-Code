<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facebook' => 'http://facebook.com',
            'instagram' => 'http://instagram.com',
            'twitter' => 'http://twitter.com',
            'phone' => '+966 523 458 322',
            'whatsapp' => '+966 523 458 322',
            'email' => 'dinein@example.com',
            'address' => 'KSA,GADh',
        ];
    }
}

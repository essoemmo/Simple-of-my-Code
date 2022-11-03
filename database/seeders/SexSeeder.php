<?php

namespace Database\Seeders;

use App\Models\Sex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexs = [

            [
                'title_ar' => 'ذكر',
                'title_en' => 'boy',
            ],
            [
                'title_ar' => 'فتاه',
                'title_en' => 'girl',
            ]

        ];

        foreach ($sexs as $sex) {
            Sex::create($sex);
        }
    }
}

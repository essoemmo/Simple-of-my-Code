<?php

namespace Database\Seeders;

use App\Models\OrderType;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [

            [
                'title_ar' => 'تيك اواى',
                'title_en' => 'Takeaway',
            ],
            [
                'title_ar' => 'حجز',
                'title_en' => 'Reservation',
            ],
            [
                'title_ar' => 'داخل المطعم',
                'title_en' => 'Inside restaurant',
            ],
        ];

        foreach ($types as $type) {
            OrderType::create($type);
        }
    }
}

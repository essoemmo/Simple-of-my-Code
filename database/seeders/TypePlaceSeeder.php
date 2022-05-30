<?php

namespace Database\Seeders;

use App\Models\TypePlace;
use Illuminate\Database\Seeder;

class TypePlaceSeeder extends Seeder
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
                'title_ar' => 'داخلى',
                'title_en' => 'Indoor',
            ],
            [
                'title_ar' => 'خارجى',
                'title_en' => 'Outdoor',
            ],
        ];

        foreach ($types as $type) {
            TypePlace::create($type);
        }
    }
}

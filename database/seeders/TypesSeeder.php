<?php

namespace Database\Seeders;

use App\Models\Type;
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
                'title_ar' => 'ولى امر',
                'title_en' => 'Parent',
            ],
            [
                'title_ar' => 'مؤسسة',
                'title_en' => 'Organization',
            ],
            [
                'title_ar' => 'بائع',
                'title_en' => 'Seller',
            ],
            [
                'title_ar' => 'طفل',
                'title_en' => 'kid',
            ]

        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}

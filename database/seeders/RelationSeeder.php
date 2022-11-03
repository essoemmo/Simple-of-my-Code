<?php

namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relats = [

            [
                'title_ar' => 'اب',
                'title_en' => 'Father',
            ],
            [
                'title_ar' => 'ام',
                'title_en' => 'Mother',
            ]

        ];

        foreach ($relats as $rel) {
            Relation::create($rel);
        }
    }
}

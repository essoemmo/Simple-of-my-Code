<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(SexSeeder::class);
        $this->call(RelationSeeder::class);
        \App\Models\AboutUs::factory(1)->create();
        \App\Models\Privecy::factory(1)->create();
        \App\Models\Usage::factory(1)->create();
        \App\Models\Term::factory(1)->create();
        \App\Models\Faq::factory(10)->create();
        \App\Models\Setting::factory(1)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\TypePlace;
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
         \App\Models\AboutUs::factory(1)->create();
         \App\Models\Privecy::factory(1)->create();
         \App\Models\Usage::factory(1)->create();
         \App\Models\Term::factory(1)->create();
         \App\Models\Faq::factory(10)->create();
         \App\Models\Setting::factory(1)->create();
         $this->call(OrderStatusSeeder::class);
         $this->call(TypesSeeder::class);
         $this->call(TypePlaceSeeder::class);
         \App\Models\User::factory(10)->create();
         \App\Models\Restaurant::factory(6)->create();
         \App\Models\Category::factory(10)->create();
         \App\Models\Product::factory(10)->create();
         \App\Models\Banner::factory(8)->create();
         \App\Models\Amenity::factory(8)->create();
         \App\Models\Product::factory(15)->create();
         \App\Models\Type::factory(8)->create();
         \App\Models\Rate::factory(8)->create();
    }
}

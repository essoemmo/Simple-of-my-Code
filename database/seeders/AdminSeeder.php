<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'super admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('12345678')
        ]);

        $admin->attachRole('super_admin');
    }
}

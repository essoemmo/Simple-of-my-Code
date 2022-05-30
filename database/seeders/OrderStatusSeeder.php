<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [

            [
                'title_ar' => 'قيد الانتظار',
                'title_en' => 'pending',
            ],
        
            [
                'title_ar' => 'تم الموافقة',
                'title_en' => 'approved',
            ],
            [
                'title_ar' => 'تم التاكيد',
                'title_en' => 'confirmed',
            ],
            [
                'title_ar' => 'تم الالغاء ',
                'title_en' => 'refused',
            ],
            [
                'title_ar' => 'تم الرفض',
                'title_en' => 'rejected',
            ],
            [
                'title_ar' => 'تم التنفيذ',
                'title_en' => 'finished',
            ],
        ];

        foreach ($status as $stat) {
            OrderStatus::create($stat);
        }
    }
}

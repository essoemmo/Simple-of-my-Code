<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TakeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'take:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make takeaway orders refused in 20 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         Log::info("Cron is working fine!");
        $orders = Order::where('order_type_id',1)->where('pay_type',null)->get();

        foreach ($orders as $key => $order) {
            if ($order->created_at->diffInMinutes(Carbon::now()) >= 20) {
                $order->update([
                    'order_status_id' => 4,
                ]);
            }
        }
    }
}

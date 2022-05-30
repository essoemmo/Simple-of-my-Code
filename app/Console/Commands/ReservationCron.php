<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReservationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make reservation orders refused in 60 minutes';

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
        $reservs = Reservation::where('order_status_id',1)->get();

        foreach ($reservs as $key => $reserv) {
            if ($reserv->orders()->count()) 
                continue;

            if ($reserv->created_at->diffInMinutes(Carbon::now()) >= 60) {
                $reserv->update([
                    'order_status_id' => 4,
                ]);
            }
        }
    }
}

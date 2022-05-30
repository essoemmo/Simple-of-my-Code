<?php

namespace App\Console\Commands;

use App\Models\Invite;
use App\Models\Order;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InviteCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invite:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make invite delete in 60 minutes';

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
        //Log::info("Cron is working fine!");
        $reservs = Reservation::where('order_status_id',1)->get();

        foreach ($reservs as $reserv) {
            $invites = Invite::where('reservation_id',$reserv->id)->get();
            foreach ($invites as $invite) {
                $inv = $invite->users->orders()->where('reservation_id',$reserv->id)->count();

                if ($inv == 0 && $invite->created_at->diffInMinutes(Carbon::now()) >= 60) {
                    $invite->delete();
                }

            }
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datacheck:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        \Log::info("Cron executed at: ".Carbon::now());
        DB::table('users')->whereRaw('DATE_ADD(membership_date, INTERVAL 30 DAY) < CURDATE()')->update([
            'membership' => 0,
            'membership_status' => 'EXPIRED'
        ]);
        
        DB::table('bids')->whereRaw('expiration <= CURDATE() AND status = "ACTIVE"')->update([
            'status' => 'EXPIRED'
        ]);

        DB::table('shipments')->whereRaw('delivery_date < CURDATE() AND status = "ACTIVE"')->update([
            'status' => 'EXPIRED'
        ]);
    }
}

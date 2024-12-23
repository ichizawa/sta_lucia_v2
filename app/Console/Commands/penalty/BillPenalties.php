<?php

namespace App\Console\Commands\penalty;

use App\Models\bill\Billing;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;

class BillPenalties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:bill-penalties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if billing date_end exceeds 1 month and is unpaid, then insert penalty';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $billings = Billing::where('is_paid', 0)
        ->whereDate('date_end', '<', $today->format('Y-m-d'))
        ->get();
        
        if($billings->count() > 0){
            foreach ($billings as $billing) {
                \App\Models\bill\BillPenalties::create([
                    'bill_id' => $billing->id,
                    'remarks' => 'Late Payment Penalty',
                    'amount' => 100,
                    'balance' => 100,
                    'status' => 1,
                    'date_created' => Carbon::now()
                ]);
                $this->info("Penalty added for Billing ID: {$billing->id} with updated date_end: " . Carbon::now());
            }
        }else{
            $this->info("No unpaid billing found.");
        }
    }
}

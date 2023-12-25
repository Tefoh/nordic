<?php

namespace App\Console\Commands;

use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CalculateDailyTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-daily-transactions {--date= : format Y-m-d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = $this->option('date');
        if (! $date) {
            $date = now();
        } else {
            try {
                $date = Carbon::parse($date);
            } catch (\Exception $e) {
                $this->error('Date format can not be parsed!');
                return 1;
            }
        }

        $total = Wallet::query()->sum('amount');
        $dailyTotal = Wallet::query()
            ->whereDate('date', $date)
            ->sum('amount');

        $this->info('Total amount transactions is: '. $total);
        $this->info('Total daily amount transactions is: '. $dailyTotal);
    }
}

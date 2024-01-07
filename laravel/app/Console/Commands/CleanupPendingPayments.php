<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;

class CleanupPendingPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:pending:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears all payments from the database that have state "pending"';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // delete all payments that have state "pending" and are older than 2 hours
        try {
            Payment::where('status', 'pending')->where('updated_at', '<', now()->subHour(2))->delete();
        } catch (\Exception $e) {
            $this->error('Could not delete payments: ' . $e->getMessage());
            return 1;
        }

        $this->info('Successfully deleted all open payments');
        return Command::SUCCESS;
    }
}

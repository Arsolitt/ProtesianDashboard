<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ExportUsersToJsonCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = Carbon::now();
        $filename = storage_path('export/users.json');
        touch($filename);
        $file = fopen($filename, 'w');
        $first = true;

        User::select(['id', 'email', 'credits', 'referral_code'])->chunk(100, function ($users) use ($file, &$first) {
            foreach ($users as $user) {
                $this->line('Processing: ' . $user->email);
                $data = $user->toArray();

                $data['payments'] = $user->payments()
                    ->where('status', '=', 'paid')
                    ->where('payment_method', '=', 'yookassa')
                    ->select(['amount', 'payment_id'])
                    ->orderBy('updated_at', 'desc')
                    ->get()
                    ->toArray();

                $data['referrals'] = [];

                DB::table('user_referrals')
                    ->where('referral_id', '=', $user->id)
                    ->select(['registered_user_id'])
                    ->orderBy('updated_at', 'desc')
                    ->chunk(1, function ($referrals) use (&$data) {
                        foreach ($referrals as $referral) {
                            $data['referrals'][] = User::where('id', '=', $referral->registered_user_id)->select('email')->first()->email;
                        }
                    });

                $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                if ($first) {
                    fwrite($file, '[' . $json);
                    $first = false;
                } else {
                    fwrite($file, ',' . $json);
                }
            }
        });

        fwrite($file, ']');
        fclose($file);

        $this->info('The users have been saved to users.json');
        return CommandAlias::SUCCESS;
    }
}

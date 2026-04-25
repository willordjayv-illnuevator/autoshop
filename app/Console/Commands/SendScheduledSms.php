<?php

namespace App\Console\Commands;
use App\Models\Schedule;
use Illuminate\Support\Facades\Log;


use Illuminate\Console\Command;

class SendScheduledSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    // public function handle()
    // {
    //     $schedules = Schedule::get();
    //      $schedules = Schedule::pending()
    //         ->where('send_at', '<=', now())
    //         ->get();
    //     Log::info('SMS COMMAND TRIGGERED');
    //     Log::info('Schedules found: ' . $schedules->count());

    //     return;
    // }

    public function handle()
    {
        $schedules = Schedule::pending()
            // ->where('send_at', '<=', now())
            ->get();

        foreach ($schedules as $schedule) {

            try {
                $message = $schedule->template->message_body;

                $message = str_replace('{fname}', $schedule->customer->fname, $message);
                $message = str_replace('{vehicle}', $schedule->vehicle->make, $message);

                // 2. SEND SMS (placeholder for now)
                // SmsService::send($schedule->customer->phone, $message);

                // 3. Update status
                $schedule->markAsSent();

            } catch (\Exception $e) {
                $schedule->markAsFailed();
            }
        }
    }
}

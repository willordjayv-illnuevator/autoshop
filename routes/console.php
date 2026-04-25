<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test:run', function () {
    $this->info('It works!');
});

Schedule::call(function () {
    Log::info('CRON TEST WORKING');
})->everyMinute();

// SMS SCHEDULER (your real command)
Schedule::command('sms:send-scheduled')
    ->everyMinute();

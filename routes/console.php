<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\ScheduledMessage;
use App\Jobs\SendTelegramMessage;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $pending = ScheduledMessage::whereNull('sent_at')
        ->where('scheduled_at', '<=', now())
        ->get();

    foreach ($pending as $msg) {
        SendTelegramMessage::dispatch($msg);
    }
})->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

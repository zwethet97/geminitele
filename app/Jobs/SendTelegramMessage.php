<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendTelegramMessage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        \Telegram\Bot\Laravel\Facades\Telegram::sendMessage([
            'chat_id' => $this->scheduledMessage->chat_id,
            'text' => $this->scheduledMessage->body,
        ]);

        $this->scheduledMessage->update(['sent_at' => now()]);
    }
}

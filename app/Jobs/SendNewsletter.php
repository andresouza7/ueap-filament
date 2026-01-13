<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(public string $content) {}

    public function handle()
    {
        Subscriber::where('active', true)
            ->chunk(1, function ($subscribers) {
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)
                        ->send(new NewsletterMail($this->content));

                    sleep(1); // evita bloqueio do Gmail
                }
            });
    }
}
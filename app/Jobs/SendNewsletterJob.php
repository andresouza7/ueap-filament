<?php

namespace App\Jobs;

use App\Mail\NewsletterSubscribed;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue = 'newsletter';

    public function handle(): void
    {
        Subscriber::where('active', true)
            ->chunk(50, function ($subscribers) {
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)
                        ->send(new NewsletterSubscribed());

                    sleep(2); // throttle simples (Gmail-safe)
                }
            });
    }
}

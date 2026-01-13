<?php

namespace App\Jobs;

use App\DTOs\NewsletterItem;
use App\Mail\NewsletterMail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param Collection<int, NewsletterItem> $items
     */
    public function __construct(
        protected Collection $items
    ) {}

    public function handle(): void
    {
        Subscriber::where('active', true)
            ->chunk(1, function ($subscribers) {
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)
                        ->send(new NewsletterMail($this->items));

                    sleep(1);
                }
            });
    }
}

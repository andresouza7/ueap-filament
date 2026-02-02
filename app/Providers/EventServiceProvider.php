<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSending;
use App\Listeners\LogOutgoingMail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MessageSending::class => [
            LogOutgoingMail::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}

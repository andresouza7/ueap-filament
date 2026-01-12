<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNewsletterCommand extends Command
{
    protected $signature = 'newsletter:send {content}';

    public function handle()
    {
        SendNewsletter::dispatch($this->argument('content'));
    }
}

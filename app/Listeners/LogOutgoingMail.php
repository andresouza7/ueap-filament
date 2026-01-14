<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mime\Email;

class LogOutgoingMail
{
    public function handle(MessageSending $event): void
    {
        $message = $event->message;

        // Garantir que é um Email (Symfony)
        if (! $message instanceof Email) {
            return;
        }

        // Destinatários
        $to = collect($message->getTo())->map(fn ($addr) => $addr->getAddress())->all();

        // Assunto
        $subject = $message->getSubject();

        // Corpo do email (HTML ou texto)
        $body = null;

        if ($message->getHtmlBody()) {
            $body = $message->getHtmlBody();
        } elseif ($message->getTextBody()) {
            $body = $message->getTextBody();
        }

        Log::debug('📧 EMAIL SEND INTERCEPTED', [
            'to' => $to,
            'subject' => $subject,
            'body' => $body,
        ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscriber;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Conteúdo do digest (coleção de DTOs ou array)
     */
    public function __construct(
        public mixed $content,
        public Subscriber $subscriber
    ) {}

    public function build()
    {
        $unsubscribeUrl = route('newsletter.unsubscribe', $this->subscriber->unsubscribe_token);

        return $this
            ->subject('Nova publicação - UEAP')
            ->view('emails.newsletter')
            ->with([
                'content' => $this->content,
            ])
            ->withSymfonyMessage(function ($message) use ($unsubscribeUrl) {
                $message->getHeaders()->addTextHeader('List-Unsubscribe', '<' . $unsubscribeUrl . '>');
            });
    }
}

<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param Collection $items  Coleção de DTOs (NewsletterItem)
     */
    public function __construct(
        protected Collection $items
    ) {}

    public function handle(): void
    {
        try {
            Log::info(
                'Iniciando envio da Newsletter',
                [
                    'itens' => $this->items->count(),
                ]
            );

            $totalSent = 0;

            Subscriber::where('active', true)
                ->chunk(1, function ($subscribers) use (&$totalSent) {
                    foreach ($subscribers as $subscriber) {
                        try {
                            // dd($this->items);
  			 Log::info('Enviando para: ' . $subscriber->email);
                            Mail::to($subscriber->email)
                                ->send(new NewsletterMail($this->items, $subscriber));

                            $totalSent++;

                            // Throttle conservador (Gmail-safe)
                            sleep(30);
                        } catch (\Throwable $e) {
                            Log::error(
                                'Erro ao enviar newsletter',
                                [
                                    'email' => $subscriber->email,
                                    'error' => $e->getMessage(),
                                ]
                            );
                            // continua com os próximos
                        }
                    }
                });

            Log::info(
                'Envio de Newsletter finalizado',
                [
                    'total_enviado' => $totalSent,
                ]
            );
        } catch (\Throwable $e) {
            Log::critical(
                'Falha crítica no Job de Newsletter',
                [
                    'error' => $e->getMessage(),
                ]
            );

            // Marca o job como failed
            throw $e;
        }
    }
}

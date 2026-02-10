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
     * Define a fila específica para este Job.
     */
    public $queue = 'newsletter';

    /**
     * O tempo (em segundos) que o job pode levar para ser processado.
     * Importante para envios em massa que levam tempo.
     */
    public $timeout = 3600;

    /**
     * Número de tentativas em caso de falha.
     */
    public $tries = 3;

    /**
     * @param Collection $items Coleção de DTOs (NewsletterItem)
     */
    public function __construct(
        protected Collection $items
    ) {}

    public function handle(): void
    {
        Log::info('Iniciando envio em massa da Newsletter', ['postagens' => $this->items->count()]);

        $totalSent = 0;
        $totalFailed = 0;

        // chunkById é mais estável para tabelas grandes
        Subscriber::query()
            ->chunkById(50, function ($subscribers) use (&$totalSent, &$totalFailed) {
                foreach ($subscribers as $subscriber) {
                    try {
                        Mail::to($subscriber->email)
                            ->send(new NewsletterMail($this->items, $subscriber));

                        $totalSent++;

                        // Delay para evitar picos de envio (rate limiting conservador)
                        // Google sugere evitar disparos simultâneos gigantescos
                        usleep(500000); // 0.5 segundos entre cada e-mail

                    } catch (\Throwable $e) {
                        $totalFailed++;
                        Log::warning('Falha ao enviar newsletter individual', [
                            'email' => $subscriber->email,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                // Pequena pausa entre lotes de 50 para "respiro" do SMTP
                sleep(2);
            });

        Log::info('Processamento de Newsletter concluído', [
            'sucesso' => $totalSent,
            'falhas' => $totalFailed,
        ]);
    }
}

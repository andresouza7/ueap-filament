<?php

namespace App\Jobs;

use App\Models\Subscriber; // Referência do seu Model
use App\Mail\NewsletterMail; // Referência da sua classe de e-mail
use Illuminate\Support\Facades\Mail; // Facade para envio
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable as QueueableTrait; // Aliasing para não conflitar com a trait original se necessário
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $content) {}

    public function handle()
    {
        try {
            Log::info("Iniciando envio de Newsletter. Conteúdo: " . substr($this->content, 0, 50) . "...");

            $totalSent = 0;

            Subscriber::where('active', true)
                ->chunk(1, function ($subscribers) use (&$totalSent) {
                    foreach ($subscribers as $subscriber) {
                        try {
                            Mail::to($subscriber->email)
                                ->send(new NewsletterMail($this->content));

                            $totalSent++;
                            sleep(30);
                        } catch (\Exception $e) {
                            Log::error("Erro ao enviar para {$subscriber->email}: " . $e->getMessage());
                            // O loop continua para o próximo inscrito mesmo se um falhar
                        }
                    }
                });

            Log::info("Newsletter finalizada com sucesso. Total enviado: {$totalSent}");
        } catch (\Exception $e) {
            Log::critical("Falha crítica no Job de Newsletter: " . $e->getMessage());

            // Lança a exceção para que o Laravel marque o job como 'failed' na tabela
            throw $e;
        }
    }
}

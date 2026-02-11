<?php

namespace App\Console\Commands;

use App\DTOs\NewsletterItem;
use App\Jobs\SendNewsletter;
use App\Models\WebPost;
use Illuminate\Console\Command;

class NewsletterCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia a newsletter com as 5 postagens mais recentes para todos os inscritos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando as últimas postagens para a newsletter...');

        $items = WebPost::query()
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn($post) => new NewsletterItem(
                title: $post->title,
                excerpt: $post->resume ?? str($post->title)->limit(140),
                url: url('/postagem/' . $post->slug),
                publishedAt: $post->created_at->format('d/m/Y'),
                image_url: $post->image_url,
            ));

        if ($items->isEmpty()) {
            $this->warn('Nenhuma postagem publicada encontrada para enviar.');
            return;
        }

        $this->info("Disparando newsletter com {$items->count()} itens...");

        SendNewsletter::dispatch($items);

        $this->info('Job de newsletter enviado para a fila com sucesso!');
    }
}

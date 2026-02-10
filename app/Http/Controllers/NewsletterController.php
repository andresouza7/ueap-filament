<?php

namespace App\Http\Controllers;

use App\DTOs\NewsletterItem;
use App\Jobs\SendNewsletter;
use App\Models\Subscriber;
use App\Models\WebPage;
use Illuminate\Http\Request;
use App\Mail\NewsletterSubscribed;
use App\Models\WebPost;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    /**
     * Cadastro individual (confirmação)
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'active' => true,
            'unsubscribe_token' => Str::uuid(),
        ]);

        // email de confirmação (ok ser síncrono ou queued)
        Mail::to($subscriber->email)->send(new NewsletterSubscribed());

        return redirect()
            ->to(url()->previous() . '#newsletter')
            ->with('success', 'Email cadastrado com sucesso!');
    }


    //método do unsubscribe
    public function unsubscribe(string $token)
    {
        $subscriber = Subscriber::where('unsubscribe_token', $token)->first();

        if (! $subscriber) {
            return response()->view('newsletter.unsubscribe-invalid');
        }

        $subscriber->delete();

        return response()->view('newsletter.unsubscribe-success');
    }



    /**
     * Disparo do digest (admin / cron / botão)
     */
    public function dispatch()
    {
        // 1️⃣ Busca as 5 últimas notícias publicadas
        $items = WebPost::query()
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn($post) => new NewsletterItem(
                title: $post->title,
                excerpt: $post->resume
                    ?? str($post->title)->limit(140),
                url: url('/postagem/' . $post->slug),
                publishedAt: $post->created_at->format('d/m/Y'),
                image_url: $post->image_url,
            ));

        // 2️⃣ Dispara o Job (NÃO chama handle)
        SendNewsletter::dispatch($items);

        // 3️⃣ Resposta HTTP imediata
        return response()->json([
            'status' => 'ok',
            'message' => 'Newsletter enviada para a fila',
            'itens' => $items->count(),
        ]);
    }
    public function previewNewsletter()
    {
        $subscriber = new Subscriber(['unsubscribe_token' => 'dummy-token']);
        $content = collect([
            new NewsletterItem(
                title: 'Exemplo de Notícia Ueap',
                excerpt: 'Este é um exemplo de resumo de notícia para visualização da newsletter.',
                url: '#',
                publishedAt: now()->format('d/m/Y'),
                image_url: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&auto=format&fit=crop&q=60'
            ),
            new NewsletterItem(
                title: 'Outra Notícia Importante',
                excerpt: 'Mais um exemplo para compor o layout da newsletter.',
                url: '#',
                publishedAt: now()->subDay()->format('d/m/Y'),
                image_url: null
            ),
            new NewsletterItem(
                title: 'Processo Seletivo Aberto',
                excerpt: 'Confira os detalhes do novo edital publicado recentemente.',
                url: '#',
                publishedAt: now()->subDays(2)->format('d/m/Y'),
                image_url: 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&auto=format&fit=crop&q=60'
            ),
        ]);

        return view('emails.newsletter', compact('content', 'subscriber'));
    }

    public function previewSubscribed()
    {
        return view('emails.newsletter-subscribed');
    }
}

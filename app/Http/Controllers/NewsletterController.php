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

        $subscriber->update([
            'active' => false,
        ]);

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
            ->map(fn ($post) => new NewsletterItem(
                title: $post->title,
                excerpt: $post->resume
                    ?? str($post->title)->limit(140),
                url: url('/postagem/' . $post->slug),
                publishedAt: $post->created_at->format('d/m/Y'),
                image_url: $post->image_url,
            ));

        dd($items);

        // 2️⃣ Dispara o Job (NÃO chama handle)
        SendNewsletter::dispatch($items);

        // 3️⃣ Resposta HTTP imediata
        return response()->json([
            'status' => 'ok',
            'message' => 'Newsletter enviada para a fila',
            'itens' => $items->count(),
        ]);
    }
}

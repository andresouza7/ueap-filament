<?php

namespace App\Http\Controllers;

use App\DTOs\NewsletterItem;
use App\Jobs\SendNewsletter;
use App\Models\Subscriber;
use App\Models\WebPage;
use Illuminate\Http\Request;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Mail;

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
        ]);

        // email de confirmação (ok ser síncrono ou queued)
        Mail::to($subscriber->email)->send(new NewsletterSubscribed());

        return redirect()
            ->to(url()->previous() . '#newsletter')
            ->with('success', 'Email cadastrado com sucesso!');
    }

    /**
     * Disparo do digest (admin / cron / botão)
     */
    public function dispatch()
    {
        // 1️⃣ Busca as 5 últimas notícias publicadas
        $items = WebPage::query()
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get([
                'slug',
                'title',
                'description',
                'created_at',
            ])
            ->map(fn ($page) => new NewsletterItem(
                title: $page->title,
                excerpt: $page->description
                    ?? str($page->title)->limit(140),
                url: url('/' . $page->slug),
                publishedAt: $page->created_at->format('d/m/Y'),
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
}

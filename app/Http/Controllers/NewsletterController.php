<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Mail;



class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->email,
            'active' => true,
        ]);

        Mail::to($subscriber->email)->send(new NewsletterSubscribed());

        return redirect()
            ->to(url()->previous() . '#newsletter')
            ->with('success', 'Email cadastrado com sucesso!');
    }

    public function dispatch(Request $request) {


        $message = "teste";

        $service = new SendNewsletter($message);

        $service->handle();

        return "enviando emails...";
    }
}
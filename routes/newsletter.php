<?php

use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

##################
## NEWSLETTER
####################

//ROTA DO SUBSCRIBE
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->middleware('throttle:3,1')
    ->name('newsletter.subscribe');

//ROTA DO UNSUBSCRIBE
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
    ->middleware('throttle:3,1')
    ->name('newsletter.unsubscribe');

//Rota do email em massa
Route::get('/newsletter', [NewsletterController::class, 'dispatch'])
    ->name('newsletter.dispatch');

// Preview Routes
Route::get('/newsletter/preview', [NewsletterController::class, 'previewNewsletter'])->name('newsletter.preview');
Route::get('/newsletter/subscribed/preview', [NewsletterController::class, 'previewSubscribed'])->name('newsletter.subscribed.preview');

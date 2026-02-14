<?php

use App\Http\Controllers\Intranet\AuthController;
use App\Http\Controllers\Intranet\GoogleController;
use Illuminate\Support\Facades\Route;

// Exibir tela de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')
    ->middleware('guest');

// Processar o login com limite de 5 tentativas por minuto
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

// Rotas de call back da autenticação OAuth2
Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);

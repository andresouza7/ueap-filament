<?php

use App\Http\Controllers\Intranet\IntranetController;
use Illuminate\Support\Facades\Route;

// Intercepta o subdominio da intranet
Route::domain(env('INTRANET_URL'))->group(function () {
    // Roteia para o painel /app do filament
    Route::get('/', fn() => to_route('filament.app.pages.dashboard'));

    // Rota para impressão da folha de ponto na view blade, não renderizado pelo filament
    Route::get('/frequency', [IntranetController::class, 'frequencyPrint'])->name('frequency.print');

    // Marca o tutorial de boas vindas da intranet como completo
    Route::get('tutorial/complete', [IntranetController::class, 'completeWelcomeTutorial'])->name('tutorial.complete');
});

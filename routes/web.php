<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/frequency', [ManagerController::class, 'frequencyPrint'])->name('frequency.print');

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/pagina/{slug}', [PageController::class, 'show'])->name('page.show');

Route::get('/login', function () {
    return redirect()->route('filament.app.auth.login');
})->name('login');

<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/pagina/{slug}', [PageController::class, 'show'])->name('page.show');

Route::get('/login', function () {
    return redirect()->route('filament.app.auth.login');
})->name('login');

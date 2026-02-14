<?php

use App\Http\Controllers\Site\PageController;
use Illuminate\Support\Facades\Route;

Route::name('site.')->group(function () {
    Route::get('/',                         [PageController::class, 'home'])->name('home');
    Route::get('/postagens',                [PageController::class, 'postList'])->name('post.list');
    Route::get('/postagem/{slug}',          [PageController::class, 'postShow'])->name('post.show');
    Route::get('/pagina/{slug}',            [PageController::class, 'postShow'])->name('page.show');

    Route::name('documentos.')->group(function () {
        Route::get('consu/portarias',      [PageController::class, 'listOrdinance'])->name('ordinance.list');
        Route::get('consu/resolucoes',      [PageController::class, 'listResolution'])->name('resolution.list');
        Route::get('calendario-academico',      [PageController::class, 'calendarList'])->name('calendar.list');
        Route::get('cursos/{slug}',             [PageController::class, 'courseList'])->name('course.list');
    });
});

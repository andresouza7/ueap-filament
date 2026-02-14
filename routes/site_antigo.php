<?php

use App\Http\Controllers\SiteAntigo\ConsuController;
use App\Http\Controllers\SiteAntigo\OldPageController;
use App\Http\Controllers\SiteAntigo\SearchController;
use Illuminate\Support\Facades\Route;

// Rotas do site institucional antigo
Route::domain('http://old.localhost')->name('old.site.')->group(function () {
    Route::get('/',                         [OldPageController::class, 'home'])->name('home');
    Route::get('/postagens',                [OldPageController::class, 'postList'])->name('post.list');
    Route::get('/postagem/{slug}',          [OldPageController::class, 'postShow'])->name('post.show');
    Route::get('/pagina/{slug}',            [OldPageController::class, 'pageShow'])->name('page.show');
    Route::get('/documentos/{slug}',        [OldPageController::class, 'documentList'])->name('document.list');
    Route::get('/instrucoes_normativas/{slug?}', [OldPageController::class, 'normativeInstructionList'])->name('normative-instruction.list');

    Route::name('document.')->group(function () {
        Route::get('consu/portarias',      [ConsuController::class, 'listOrdinance'])->name('consu-ordinance.list');
        Route::get('consu/resolucoes',      [ConsuController::class, 'listResolution'])->name('resolution.list');
        Route::get('/atas/{issuer}',       [ConsuController::class, 'listAta'])->name('ata.list');
    });

    Route::get('/busca', [SearchController::class, 'index'])->name('search');
});

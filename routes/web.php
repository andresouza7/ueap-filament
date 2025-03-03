<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ConsuController;
use App\Http\Controllers\OldPageController;
use App\Http\Controllers\TransparencyController;
use App\Models\Document;
use App\Models\WebPost;
use App\Services\TransparenciaSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function () {
    $documents = Document::with('category')->first();
    dd($documents);
    // return view('home');
});

Route::get('/tailwind', function() {
    return view('tailwind');
});

Route::get('/frequency', [ManagerController::class, 'frequencyPrint'])->name('frequency.print');

Route::get('/login', function () {
    return redirect()->route('filament.app.auth.login');
})->name('login');


Route::name('site.')->group(function () {
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
        //     Route::get('/',                 [TransparencyController::class, 'home']            )->name('home');
        //     Route::get('/agenda',           [TransparencyController::class, 'listCalendar']    )->name('calendar.list');
    });
});

Route::name('novosite.')->prefix('/novo')->group(function () {
    Route::get('/',                         [PageController::class, 'home'])->name('home');
    Route::get('/postagens',                [PageController::class, 'postList'])->name('post.list');
    Route::get('/postagem/{slug}',          [PageController::class, 'postShow'])->name('post.show');
    Route::get('/pagina/{slug}',            [PageController::class, 'pageShow'])->name('page.show');
    Route::get('/documentos/{slug}',        [PageController::class, 'documentList'])->name('document.list');
    Route::get('/instrucoes_normativas/{slug?}', [PageController::class, 'normativeInstructionList'])->name('normative-instruction.list');

    Route::name('document.')->group(function () {
        Route::get('consu/portarias',      [ConsuController::class, 'listOrdinance'])->name('consu-ordinance.list');
        Route::get('consu/resolucoes',      [ConsuController::class, 'listResolution'])->name('resolution.list');
        Route::get('/atas/{issuer}',       [ConsuController::class, 'listAta'])->name('ata.list');
        //     Route::get('/',                 [TransparencyController::class, 'home']            )->name('home');
        //     Route::get('/agenda',           [TransparencyController::class, 'listCalendar']    )->name('calendar.list');
    });
});

Route::get('/search', function (Request $request) {
    $query = $request->input('q');

    if (!$query) {
        return response()->json(['error' => 'No search query provided.'], 400);
    }

    $service = new TransparenciaSearchService();
    $results = $service->search($query);
    return response()->json($results);
});

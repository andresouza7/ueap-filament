<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ConsuController;
use App\Http\Controllers\OldPageController;
use App\Http\Controllers\TransparencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

Route::get('/frequency', [ManagerController::class, 'frequencyPrint'])->name('frequency.print');

Route::get('tutorial/complete', [ManagerController::class, 'completeTutorial'])->name('tutorial.complete');

Route::get('/login', function () {
    return redirect()->route('filament.app.auth.login');
})->name('login');

Route::domain(env('SITE_URL'))->name('site.')->group(function () {
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

Route::domain(env('INTRANET_URL'))->group(function () {
    Route::get('/', function () {
        return redirect()->route('filament.app.pages.dashboard');
    });
});

Route::domain(env('TRANSPARENCY_URL'))->name('transparency.')->group(function () {
    //Route::name('transparency.')->prefix('/portal-transparencia')->group(function () {
    Route::get('/',                     [TransparencyController::class, 'home'])->name('home');
    Route::get('/navigation/{type}',    [TransparencyController::class, 'navigation'])->name('navigation');


    Route::get('/documentos/{slug}',    [TransparencyController::class, 'documentList'])->name('document.list');

    ##################
    ## INSTITUCIONAL
    #####################
    Route::get('/institutional',    [TransparencyController::class, 'institutional'])->name('institutional');
    Route::get('/organograma',      [TransparencyController::class, 'organization'])->name('organization');
    Route::get('/servidores',       [TransparencyController::class, 'listEffectiveRoles'])->name('effective-role.list');
    Route::get('/cargos',           [TransparencyController::class, 'listCommissionedRoles'])->name('commissioned-role.list');

    ##################
    ## Execução Orçamentária e Finanças
    #####################

    Route::get('/order/{type}',            [TransparencyController::class, 'listOrder'])->name('order.list');
    Route::get('/folha-de-pagamento',   [TransparencyController::class, 'listPayRoll'])->name('payroll.list');
    Route::get('/quadro-despesas',            [TransparencyController::class, 'listQuadroDespesas'])->name('quadro-despesas.list');
    Route::get('/quadro-despesas/{ano}',            [TransparencyController::class, 'showQuadroDespesasMes'])->name('quadro-despesas.show');
    Route::get('/dotacoes',            [TransparencyController::class, 'listDotacoes'])->name('dotacoes.list');
    Route::get('/dotacoes/{ano}',            [TransparencyController::class, 'showDotacoes'])->name('dotacoes.show');

    Route::get('/licitacoes',               [TransparencyController::class, 'listBid'])->name('bid.list');
    Route::get('/licitacao/{uuid}',         [TransparencyController::class, 'showBid'])->name('bid.show');
    Route::get('/contratos/{type?}',        [TransparencyController::class, 'listContract'])->name('contract.list');
    Route::get('/contrato/{uuid}',          [TransparencyController::class, 'showContract'])->name('contract.show');
    Route::get('/registro-preco',           [TransparencyController::class, 'listPriceRecord'])->name('price-record.list');
    Route::get('/registro-preco/{uuid}',    [TransparencyController::class, 'showPriceRecord'])->name('price-record.show');

    Route::get('/bolsas-e-auxilio', [TransparencyController::class, 'listStudentAssistance'])->name('student-assistance.list');
    Route::get('/convenios',        [TransparencyController::class, 'listAgreement'])->name('agreement.list');

    Route::get('/auditoria',        [TransparencyController::class, 'audit'])->name('audit.list');
});

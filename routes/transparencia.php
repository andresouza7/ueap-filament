<?php

use App\Http\Controllers\TransparencyController;
use Illuminate\Support\Facades\Route;

// Intercepta o subdominio da transparencia
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

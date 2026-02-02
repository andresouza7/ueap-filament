<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IntranetController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ConsuController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OldPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransparencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//
use App\Http\Controllers\NewsletterController;
//


// Intercepta o subdominio da intranet
Route::domain(env('INTRANET_URL'))->group(function () {
    // Roteia para o painel /app do filament
    Route::get('/', fn() => to_route('filament.app.pages.dashboard'));

    // Rota para impressão da folha de ponto na view blade, não renderizado pelo filament
    Route::get('/frequency', [IntranetController::class, 'frequencyPrint'])->name('frequency.print');

    // Marca o tutorial de boas vindas da intranet como completo
    Route::get('tutorial/complete', [IntranetController::class, 'completeWelcomeTutorial'])->name('tutorial.complete');
});

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

// ===== Daqui para baixo Intercepta todas as requisições que não caírem nos subdomínios =====

// Rotas do site institucional
Route::name('old.site.')->prefix('old/')->group(function () {
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

Route::name('site.')->group(function () {
    Route::get('/',                         [PageController::class, 'home'])->name('home');
    Route::get('/postagens',                [PageController::class, 'postList'])->name('post.list');
    Route::get('/postagem/{slug}',          [PageController::class, 'postShow'])->name('post.show');
    Route::get('/pagina/{slug}',            [PageController::class, 'postShow'])->name('page.show');

    Route::name('documentos.')->group(function () {
        Route::get('consu/portarias',      [PageController::class, 'listOrdinance'])->name('ordinance.list');
        Route::get('consu/resolucoes',      [PageController::class, 'listResolution'])->name('resolution.list');
        Route::get('calendario-academico',      [PageController::class, 'calendarList'])->name('calendar.list');
    });
});

// Exibir tela de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')
    ->middleware('guest');

// Processar o login com limite de 5 tentativas por minuto
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

// Rotas de call back da autenticação OAuth2
Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);
##################
## NEWSLETTER
#####################

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

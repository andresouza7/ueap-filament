<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PodeGerenciarControleDeFrequencia
{
    public function handle(Request $request, Closure $next): Response
    {
        $protectedRoutes = [
            'filament.app.pages.controle-frequencia',
            'filament.app.pages.controle-ponto',
            'filament.app.pages.cadastro-ponto-urh',
            'filament.app.resources.gestao.calendar-occurrences.*',
            'filament.app.resources.gestao.mapa-ferias.*',
            'filament.app.resources.gestao.tickets.*',
        ];

        if (
            $request->routeIs($protectedRoutes) &&
            !$request->user()->hasAnyRole(['urh', 'dinfo'])
        ) {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}

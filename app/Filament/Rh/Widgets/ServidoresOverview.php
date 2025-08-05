<?php

namespace App\Filament\Rh\Widgets;

use App\Models\CalendarOccurrence;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class ServidoresOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalServidores = User::count();

        $today = Carbon::today();
        $servidoresFerias = CalendarOccurrence::where('type', 2)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->count();

        $totalDocentes = User::whereHas('effective_role', function ($query) {
            $query->where('description', 'DOCENTE');
        })->count();

        $totalTecnicos = User::whereHas('effective_role', function ($query) {
            $query->where('description', '<>', 'DOCENTE');
        })->count();

        return [
            Stat::make('Total de Servidores', $totalServidores),
            Stat::make('Servidores em Férias', $servidoresFerias),
            Stat::make('Total de Docentes', $totalDocentes),
            Stat::make('Total de Técnicos', $totalTecnicos),
        ];
    }
}

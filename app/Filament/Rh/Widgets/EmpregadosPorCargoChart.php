<?php

namespace App\Filament\Rh\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EmpregadosPorCargoChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        // Agrupar os usuários por cargo (effective_role.description) e contar
        $cargoData = User::selectRaw('effective_roles.description as cargo, COUNT(users.id) as total')
            ->join('effective_roles', 'users.effective_role_id', '=', 'effective_roles.id')
            ->groupBy('effective_roles.description')
            ->orderBy('total', 'desc')
            ->get();

        return [
            // 'datasets' => [
            //     [
            //         'label' => 'Empregados',
            //         'data' => $cargoData->pluck('total'),
            //     ],
            // ],
            // 'labels' => $cargoData->pluck('cargo'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true, // 👈 isso esconde os labels abaixo do gráfico
                ],
            ],
        ];
    }
}

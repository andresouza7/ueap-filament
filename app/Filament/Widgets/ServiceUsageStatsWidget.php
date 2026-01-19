<?php

namespace App\Filament\Widgets;

use App\Models\ServiceAccessLog;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ServiceUsageStatsWidget extends ChartWidget
{
    protected ?string $heading = 'Acessos por Serviço (Ano Atual)';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = ServiceAccessLog::select('service', DB::raw('count(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('service')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Acessos',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => '#36A2EB',
                ],
            ],
            'labels' => $data->pluck('service')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

<?php

namespace App\Filament\Rh\Widgets;

use App\Models\CalendarOccurrence;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class FeriasChart extends ChartWidget
{
    protected static ?string $heading = 'Mapa de Férias';

    protected function getData(): array
    {
        $year = now()->year;

        // Initialize the array with zeroes for each month
        $vacationCounts = collect(range(1, 12))->mapWithKeys(function ($month) {
            return [Carbon::create()->month($month)->format('F') => 0];
        });

        $vacations = CalendarOccurrence::where('type', 2)
            ->whereYear('start_date', '<=', $year)
            ->whereYear('end_date', '>=', $year)
            ->get();

        foreach ($vacations as $vacation) {
            $start = Carbon::parse($vacation->start_date)->startOfMonth();
            $end = Carbon::parse($vacation->end_date)->endOfMonth();

            $period = Carbon::parse($start)->monthsUntil($end);

            foreach ($period as $date) {
                $monthName = $date->format('F');

                if ($date->year === $year) {
                    $vacationCounts = $vacationCounts->map(function ($value, $key) use ($monthName) {
                        return $key === $monthName ? $value + 1 : $value;
                    });
                }
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Servidores em Férias',
                    'data' => array_values($vacationCounts->toArray()),
                ],
            ],
            'labels' => array_keys($vacationCounts->toArray()),
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}

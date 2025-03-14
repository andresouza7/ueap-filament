<?php

namespace App\Providers;

use BezhanSalleh\PanelSwitch\PanelSwitch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                // ->visible(fn(): bool => Auth::user()?->hasRole('dinfo'))
                ->slideOver()
                ->modalHeading('Alterar Painel')
                ->modalWidth('sm')
                ->panels(['app', 'rh', 'site', 'transparencia', 'admin'])
                ->icons([
                    'app' => 'heroicon-o-user',
                    'admin' => 'heroicon-o-key',
                    // 'cpa' => 'heroicon-o-academic-cap',
                    'rh' => 'heroicon-o-archive-box',
                    'site' => 'heroicon-o-globe-alt',
                    'transparencia' => 'heroicon-o-chart-pie',
                ], $asImage = false)
                ->labels([
                    'app' => 'Social',
                    'admin' => 'Admin',
                    'rh' => 'Recursos Humanos',
                    'site' => 'Web',
                    'transparencia' => 'Transparência',
                ], $asImage = false);
        });
    }
}

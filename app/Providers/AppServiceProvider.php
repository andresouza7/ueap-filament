<?php

namespace App\Providers;

use BezhanSalleh\PanelSwitch\PanelSwitch;
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
                ->visible(fn(): bool => auth()->user()?->hasRole('dinfo'))
                ->slideOver()
                ->modalHeading('Alterar Painel')
                ->modalWidth('sm')
                ->icons([
                    'app' => 'heroicon-o-user',
                    'admin' => 'heroicon-o-key',
                ], $asImage = false)
                ->labels([
                    'app' => 'Usuário',
                    'adin' => 'Admin',
                ], $asImage = false);
        });
    }
}

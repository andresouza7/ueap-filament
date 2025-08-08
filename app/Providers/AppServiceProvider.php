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
                ->panels(['app', 'admin'])
                ->icons([
                    'app' => 'heroicon-o-user',
                    'admin' => 'heroicon-o-key',
                ], $asImage = false)
                ->labels([
                    'app' => 'Social',
                    'admin' => 'Admin',
                ], $asImage = false);
        });
    }
}

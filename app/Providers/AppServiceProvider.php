<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
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
        Paginator::useBootstrap();

        Filament::serving(function () {
            $user = Auth::user();

            if ($user && ! $user->skip_tutorial && request()->routeIs('filament.app.pages.dashboard')) {
                FilamentAsset::register([
                    // Js::make('tutorial-script', Vite::asset('resources/js/tutorial.js'))->module(),
                    Js::make('tutorial-script', asset('build/assets/tutorial-BXecf3-O.js'))->module(),
                    Css::make('tutorial-script', asset('build/assets/tutorial-BmhU-YmB.css')),
                ]);
            }
        });

        Fieldset::configureUsing(fn(Fieldset $fieldset) => $fieldset
            ->columnSpanFull());

        Grid::configureUsing(fn(Grid $grid) => $grid
            ->columnSpanFull());

        Section::configureUsing(fn(Section $section) => $section
            ->columnSpanFull());
    }
}

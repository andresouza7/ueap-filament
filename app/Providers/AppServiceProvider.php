<?php

namespace App\Providers;

use App\Listeners\LogAuthEvent;
use Filament\Facades\Filament;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Facades\CauserResolver;

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
        Gate::before(function ($user, $ability) {
            // Give full access to 'dinfo' users
            if ($user->hasRole('dinfo')) {
                return true;
            }

            // Restrict deletes to admin only
            if ($ability === 'delete' && ! $user->hasRole('dinfo')) {
                return false;
            }

            // For all other cases, fall back to normal policy checks
            return null;
        });

         FilamentAsset::register([
                    Js::make('tutorial-ponto-script', Vite::asset('resources/js/tutorial-ponto.js'))->module(),
                    
                ]);
                
        Filament::serving(function () {
            $user = Auth::user();

            if ($user && !$user->skip_tutorial && request()->routeIs('filament.app.pages.dashboard')) {
                FilamentAsset::register([
                    // Js::make('tutorial-script', Vite::asset('resources/js/tutorial.js'))->module(),
                    Js::make('tutorial-script', asset('build/assets/tutorial-BXecf3-O.js'))->module(),
                    Css::make('tutorial-script', asset('build/assets/tutorial-BmhU-YmB.css')),
                ]);
            }
            
            if ($user && !$user->skip_tutorial_ponto && request()->routeIs('filament.app.pages.dashboard')) {
               
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

<?php

namespace App\Providers\Filament;

use App\Filament\App\Pages\Auth\EditProfile;
use App\Filament\App\Pages\Auth\Login;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\View\View;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        styleFilamentPanel($panel);

        return $panel
            ->id('app')
            ->path('app')
            ->defaultThemeMode(ThemeMode::Light)
            ->databaseNotifications()
            ->brandLogo(asset('img/logo.png'))
            ->darkModeBrandLogo(asset('img/logo-white.png'))
            ->brandLogoHeight('36px')
            ->login(Login::class)
            ->profile(EditProfile::class)
            // ->passwordReset()
            ->discoverResources(in: app_path('Filament/App/Resources/Gestao'), for: 'App\\Filament\\App\\Resources\\Gestao')
            ->discoverResources(in: app_path('Filament/App/Resources/Site'), for: 'App\\Filament\\App\\Resources\\Site')
            ->discoverResources(in: app_path('Filament/App/Resources/Social'), for: 'App\\Filament\\App\\Resources\\Social')
            ->discoverResources(in: app_path('Filament/App/Resources/Transparencia'), for: 'App\\Filament\\App\\Resources\\Transparencia')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->renderHook(
                'panels::auth.login.form.before',
                fn(): string => Blade::render('<div class="flex justify-center mb-6"><img src="{{ asset("img/logo-white.png") }}" class="h-16 w-auto" /></div>')
            )
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_AFTER,
                fn(): string => Blade::render(
                    '<x-filament::button  
                        color="danger" 
                        size="sm"
                        tag="a"
                        href="https://servicedesk.ueap.edu.br/" 
                        target="_blank"
                        class="flex items-center gap-1"
                    >
                        <span class="hidden md:flex md:items-center"><x-heroicon-o-lifebuoy class="inline w-4 h-4" /> Service Desk</span>
                        <span class="text-xs md:hidden">Suporte</span>
                    </x-filament::button>'
                )
            )
            ->renderHook(
                'panels::auth.login.form.after',
                fn(): View => view('filament.app.pages.login')
            )
            ->renderHook(
                PanelsRenderHook::TOPBAR_START,
                fn(): string => Blade::render(
                    '<a href="' . route('filament.app.pages.dashboard') . '">
                        <x-filament-panels::logo />
                    </a>'
                )
            )
            ->viteTheme('resources/css/filament/app/theme.css')
            ->navigationGroups([
                'Minha Área',
                'Social',
                'Site',
                'Gestão',
                'Transparência',
            ])
            ->navigationItems([
                NavigationItem::make('Meus Dados')
                    ->url(fn() => route('filament.app.resources.servidor.view', Auth::id()))
                    ->icon('heroicon-o-user-circle')
                    ->sort(1)
                    ->group('Minha Área'),
                NavigationItem::make('Minhas Portarias')
                    ->url(fn() => route('filament.app.resources.servidor.view', [Auth::id(), 'activeRelationManager' => 1]))
                    ->icon('heroicon-o-document-text')
                    ->sort(2)
                    ->group('Minha Área'),
                NavigationItem::make('Alterar Senha')
                    ->url(fn() => route('filament.app.auth.profile'))
                    ->icon('heroicon-o-lock-closed')
                    ->sort(5)
                    ->group('Minha Área'),
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()->label('Perfil')->url('/app/edit-profile'),
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

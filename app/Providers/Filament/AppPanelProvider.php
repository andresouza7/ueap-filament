<?php

namespace App\Providers\Filament;

use App\Filament\App\Pages\Auth\EditProfile;
use App\Filament\App\Pages\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
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
            ->brandLogo(asset('img/logo.png'))
            ->darkModeBrandLogo(asset('img/logo-white.png'))
            ->brandLogoHeight('36px')
            ->login(Login::class)
            ->profile(EditProfile::class)
            // ->passwordReset()
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->renderHook(
                'panels::auth.login.form.after',
                fn(): View => view('filament.app.pages.login')
            )
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
                // ->visible(fn (): bool => auth()->user()?->user_type === 'admin'),
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

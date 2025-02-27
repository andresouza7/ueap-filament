<?php

namespace App\Filament\PortalTransparencia\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = '';
    protected static ?string $navigationLabel = 'Início';

    protected static string $view = 'filament.portal-transparencia.pages.dashboard';
}

<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Widgets\LatestPosts;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Início';
    protected static string $view = 'filament.app.pages.dashboard';
}

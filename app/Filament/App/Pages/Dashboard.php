<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Widgets\LatestPosts;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Início';
    protected string $view = 'filament.app.pages.dashboard';
}

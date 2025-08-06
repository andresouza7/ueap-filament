<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;

class ClubeVantagens extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static string $view = 'filament.app.pages.clube-vantagens';

    protected static ?string $title = 'Clube de Vantagens';

    protected ?string $heading = '';

    protected static ?string $navigationGroup = 'Social';

    protected static ?int $navigationSort = 5;
}

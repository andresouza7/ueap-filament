<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;

class ClubeVantagens extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-gift';

    protected string $view = 'filament.app.pages.clube-vantagens';

    protected static ?string $title = 'Clube de Vantagens';

    protected ?string $heading = '';

    protected static string | \UnitEnum | null $navigationGroup = 'Social';

    protected static ?int $navigationSort = 5;
}

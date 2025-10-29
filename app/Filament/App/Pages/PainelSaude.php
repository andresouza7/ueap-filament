<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;

class PainelSaude extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-heart';

    protected string $view = 'filament.app.pages.painel-saude';

    protected static ?string $title = 'Saúde e Bem-Estar';
    protected ?string $heading = '';
    protected static string | \UnitEnum | null $navigationGroup = 'Social';
    protected static ?int $navigationSort = 5;
}

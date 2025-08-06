<?php

namespace App\Filament\App\Pages;

use Filament\Pages\Page;

class PainelSaude extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static string $view = 'filament.app.pages.painel-saude';

    protected static ?string $title = 'Saúde e Bem-Estar';
    protected ?string $heading = '';
    protected static ?string $navigationGroup = 'Social';
    protected static ?int $navigationSort = 5;
}

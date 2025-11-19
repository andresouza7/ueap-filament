<?php

namespace App\Filament\App\Pages;

use BackedEnum;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ControleFrequencia extends Page
{
    protected string $view = 'filament.app.pages.controle-frequencia';
    protected static ?string $title = 'Controle de Frequência';
    protected ?string $heading = '';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedClock;
    protected static UnitEnum|string|null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 9;

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->parentItem(static::getNavigationParentItem())
                ->icon(static::getNavigationIcon())
                ->activeIcon(static::getActiveNavigationIcon())
                ->isActiveWhen(
                    fn() =>
                    request()->routeIs(
                        'filament.app.resources.gestao.mapa-ferias.*',
                        'filament.app.resources.gestao.tickets.*',
                        'filament.app.resources.gestao.calendar-occurrences.*',
                        'filament.app.pages.controle-ponto',
                        'filament.app.pages.controle-frequencia',
                    )
                )
                ->sort(static::getNavigationSort())
                ->badge(static::getNavigationBadge(), color: static::getNavigationBadgeColor())
                ->badgeTooltip(static::getNavigationBadgeTooltip())
                ->url(static::getNavigationUrl()),
        ];
    }
}

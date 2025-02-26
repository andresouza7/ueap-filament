<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\TransparencyOrder;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Orçamento extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Execução Orçamentária e Finanças';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.portal-transparencia.pages.orçamento';

    public function table(Table $table): Table
    {
        return $table
            ->query(TransparencyOrder::query()->where('type', 'income'))
            ->heading('Documentos')
            ->description('Use a caixa de pesquisa para filtrar informações')
            ->defaultSort('year', 'desc')
            ->columns([
                TextColumn::make('year')
                    ->label('Ano')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Nome')
                    ->weight('semibold')
                    ->searchable(),
            ])
            ->actions([
                Action::make('Abrir')
                    ->url('/')
            ]);
    }
}

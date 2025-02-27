<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\TransparencyOrder;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class RegistroPreco extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Licitações';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.portal-transparencia.pages.registro-preco';

    public function table(Table $table): Table
    {
        return $table
            ->query(TransparencyOrder::query()->orderBy('year', 'desc')->orderBy('month', 'desc'))
            ->heading('Documentos')
            ->description('Use a caixa de pesquisa para filtrar registros')
            ->defaultSort('id')
            ->paginated(false)
            ->columns([
                TextColumn::make('month')
                    ->label('Mês')
                    ->weight('semibold'),
                TextColumn::make('year')
                    ->label('Ano'),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),
                TextColumn::make('title')
                    ->label('Nome')
                    ->searchable()
                    ->wrap()
            ])
            ->actions([
                Action::make('Abrir')
            ]);
    }
}

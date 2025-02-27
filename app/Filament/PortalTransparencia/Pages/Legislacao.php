<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\Document;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Legislacao extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Institucional';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.portal-transparencia.pages.legislacao';

    public function table(Table $table): Table
    {
        return $table
            ->query(Document::query()->where('type', 'legislation'))
            ->heading('Legislação')
            ->description('Normativas que dispõe sobre a UEAP e seu quadro de servidores')
            ->defaultSort('id')
            ->paginated(false)
            ->columns([
                TextColumn::make('title')
                    ->label('Nome')
                    ->weight('semibold')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->wrap(),
            ])
            ->actions([
                Action::make('Abrir')
            ]);
    }
}

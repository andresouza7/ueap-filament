<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\Document;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class DemonstracoesContabeis extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Execução Orçamentária e Finanças';
    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.portal-transparencia.pages.demonstracoes-contabeis';

    public  function table(Table $table): Table
    {
        return $table
            ->query(Document::query()->whereHas('category', function ($query) {
                $query->where('type', 'transparency');
                $query->where('slug', 'demonstracoes-contabeis');
            }))
            ->heading('Documentos')
            ->description('Use a caixa de pesquisa para filtrar informações')
            ->defaultSort('year', 'desc')
            ->columns([
                TextColumn::make('year')
                    ->label('Ano')
                    ->weight('semibold')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Nome')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->wrap(),
            ])
            ->actions([
                Action::make('Abrir')
                    ->url('/')
            ]);
    }
}

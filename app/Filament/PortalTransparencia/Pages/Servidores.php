<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class Servidores extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Institucional';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.portal-transparencia.pages.servidores';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->heading('Lista de servidores da UEAP')
            ->description('Utilize os filtros e a ferramenta de pesquisa para localizar uma informação')
            ->defaultSort('login')
            ->columns([
                TextColumn::make('person.name')
                    ->label('Nome')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('effective_role.description')
                    ->label('Cargo')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('group.description')
                    ->label('Setor')
                    ->wrap(),
            ])
            ->filters([
                SelectFilter::make('effective_role_id')
                    ->label('Cargo')
                    ->relationship('effective_role', 'description'),
                SelectFilter::make('group_id')
                    ->label('Setor')
                    ->relationship('group', 'description')
            ]);
    }
}

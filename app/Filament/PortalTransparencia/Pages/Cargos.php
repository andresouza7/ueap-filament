<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\CommissionedRole;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Cargos extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Institucional';
    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.portal-transparencia.pages.cargos';

    public function table(Table $table): Table
    {
        return $table
            ->query(CommissionedRole::query()->orderBy('position')->orderBy('description'))
            ->heading('Cargos e funções comissionadas da UEAP')
            ->description('Utilize o filtro e a ferramenta de pesquisa para localizar uma informação')
            ->columns([
                TextColumn::make('description')
                    ->label('Cargo')
                    ->weight('semibold')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('occupant.person.name')
                    ->label('Ocupante')
                    ->searchable()
                    ->wrap(),
            ]);
    }
}

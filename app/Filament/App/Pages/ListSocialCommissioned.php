<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\SocialUserResource;
use App\Models\CommissionedRole;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ListSocialCommissioned extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static string $view = 'filament.app.pages.list-social-commissioned';
    protected static ?string $title = 'Cargos Comissionados';
    protected static ?string $navigationGroup = 'Social';
    protected static ?int $navigationSort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Consulta de cargos comissionados')
            ->description('Esta tabela exibe os cargos comissionados da instituição e seus responsáveis. Utilize os filtros e opções de busca para encontrar uma informação específica.')
            ->recordTitleAttribute('description')
            ->query(CommissionedRole::query())
            ->defaultSort('description')
            ->columns([
                Split::make([
                    TextColumn::make('description')
                        ->description('Cargo', 'above')
                        ->weight(FontWeight::SemiBold)
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->searchable(),
                    TextColumn::make('occupant.person.name')
                        ->description('Responsável', 'above')
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                        ->formatStateUsing(fn($state) => $state ?? '-') // Display '-' if null
                        ->url(fn($record) => $record->occupant ? SocialUserResource::getUrl('view', ['record' => $record->occupant->id]) : null) // Generate URL only if occupant exists
                        ->searchable()
                ])->from('md')

            ])
            ->filters([
                Filter::make('without_occupant')
                    ->label('Cargos Vagos')
                    ->query(fn(Builder $query) => $query->whereDoesntHave('occupant')),
            ]);
    }
}

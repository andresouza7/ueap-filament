<?php

namespace App\Filament\App\Resources\Social\Pontos;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Social\Pontos\Pages\ListPonto;
use App\Filament\App\Resources\Social\Pontos\Pages\CreatePonto;
use App\Filament\App\Resources\Social\Pontos\Pages\EditPonto;
use App\Filament\App\Resources\Social\PontoResource\Pages;
use App\Filament\App\Resources\Social\PontoResource\RelationManagers;
use App\Models\CalendarOccurrence;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PontoResource extends Resource
{
    // o unico recurso gerenciavel será o das ocorrencias de ponto
    protected static ?string $model = CalendarOccurrence::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Ocorrência do Ponto';
    protected static ?string $pluralModelLabel = 'Ocorrências do Ponto';
    protected static bool $shouldRegisterNavigation = false;
    protected static bool $shouldSkipAuthorization = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Select::make('description')
                        ->label('Tipo')
                        ->columnSpanFull()
                        ->options([
                            'PONTO FACULTATIVO' => 'PONTO FACULTATIVO',
                            'RECESSO' => 'RECESSO',
                            'ATESTADO MÉDICO' => 'ATESTADO MÉDICO',
                            'FÉRIAS DOCENTE' => 'FÉRIAS DOCENTE',
                            'LUTO OFICIAL' => 'LUTO OFICIAL',
                            'FALTA' => 'FALTA',
                            'SEM VINCULO ATIVO' => 'SEM VINCULO ATIVO',
                        ])
                        ->required(),
                    DatePicker::make('start_date')
                        ->label('Data Início')
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Data Fim')
                        ->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Minhas Ocorrências de Ponto')
            ->description('Gerencie as alterações de expediente na sua folha de ponto.')
            ->recordTitleAttribute('description')
            ->defaultSort('start_date', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', Auth::id())->where('type', 3))
            ->columns([
                TextColumn::make('description')
                    ->searchable()
                    ->label('Descrição'),
                TextColumn::make('start_date')
                    ->sortable()
                    ->dateTime('d/m/Y')
                    ->label('Data Início'),
                TextColumn::make('end_date')
                    ->sortable()
                    ->dateTime('d/m/Y')
                    ->label('Data Fim'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPonto::route('/'),
            'create' => CreatePonto::route('/create'),
            'edit' => EditPonto::route('/{record}/edit'),
        ];
    }
}

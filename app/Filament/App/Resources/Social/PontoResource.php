<?php

namespace App\Filament\App\Resources\Social;

use App\Filament\App\Resources\Social\PontoResource\Pages;
use App\Filament\App\Resources\Social\PontoResource\RelationManagers;
use App\Models\CalendarOccurrence;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
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
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Ocorrência do Ponto';
    protected static ?string $pluralModelLabel = 'Ocorrências do Ponto';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('description')
                    ->label('Tipo')
                    ->columnSpanFull()
                    ->options([
                        'FACULTADO' => 'FACULTADO',
                        'FALTA' => 'FALTA',
                        'ATESTADO' => 'ATESTADO'
                    ]),
                DatePicker::make('start_date')
                    ->label('Data Início')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Data Fim')
                    ->required()
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPonto::route('/'),
            'create' => Pages\CreatePonto::route('/create'),
            'edit' => Pages\EditPonto::route('/{record}/edit'),
        ];
    }
}

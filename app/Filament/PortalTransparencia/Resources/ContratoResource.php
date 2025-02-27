<?php

namespace App\Filament\PortalTransparencia\Resources;

use App\Filament\PortalTransparencia\Resources\ContratoResource\Pages;
use App\Filament\PortalTransparencia\Resources\ContratoResource\RelationManagers;
use App\Filament\PortalTransparencia\Resources\ContratoResource\RelationManagers\DocumentsRelationManager;
use App\Models\TransparencyBid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratoResource extends Resource
{
    protected static ?string $model = TransparencyBid::class;
    protected static ?string $modelLabel = 'Contrato';
    protected static ?string $navigationGroup = 'Contratos';
    protected static ?int $navigationSort = 1;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detalhes')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('number')->label('Número'),
                        TextEntry::make('description')->label('Objeto'),
                        TextEntry::make('location')->label('Publicado em'),
                        TextEntry::make('start_date')->label('Data de abertura')
                            ->date(),
                        TextEntry::make('link')
                            ->url(fn($state) => $state, true)
                            ->columnSpanFull(),
                        TextEntry::make('observation')
                            ->label('Observação')
                            ->columnSpanFull()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'contrato')
                ->orderBy('year', 'desc')
                ->orderBy('id', 'desc'))
            ->heading('Processos de licitação da UEAP')
            ->description('Use a ferramenta de pesquisa para localizar uma informação')
            ->columns([
                Stack::make([
                    Tables\Columns\TextColumn::make('number')
                        ->label('Número')
                        ->formatStateUsing(fn($record) => '<h3 class="text-lg font-bold">Edital: ' . $record->number . '/' . $record->year . '</h3>')
                        ->html()
                        ->sortable(),

                    Tables\Columns\TextColumn::make('description')
                        ->formatStateUsing(fn($state) => '<span><strong>Objeto:</strong> ' . $state . '</span>')
                        ->html()
                        ->searchable(),

                    Tables\Columns\TextColumn::make('location')
                        ->formatStateUsing(fn($state) => '<span><strong>Publicado em:</strong> ' . $state . '</span>')
                        ->html()
                        ->searchable(),

                    Tables\Columns\TextColumn::make('start_date')
                        ->label('Data de abertura')
                        ->formatStateUsing(fn($state) => '<span><strong>Data de abertura:</strong> ' . $state . '</span>')
                        ->html()
                        ->sortable(),

                    Tables\Columns\TextColumn::make('observation')
                        ->formatStateUsing(fn($state) => '<span class="text-gray-500"><strong>Observação:</strong> ' . $state . '</span>')
                        ->html()
                        ->searchable(),
                ])->space(1)
            ])
            ->contentGrid([
                'sm' => 1,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DocumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContrato::route('/'),
            'view' => Pages\ViewContrato::route('/{record}'),
        ];
    }
}

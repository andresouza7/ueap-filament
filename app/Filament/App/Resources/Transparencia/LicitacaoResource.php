<?php

namespace App\Filament\Transparencia\Resources;

use App\Filament\Transparencia\Resources\LicitacaoResource\Pages;
use App\Filament\Transparencia\Resources\LicitacaoResource\Pages\EditLicitacao;
use App\Filament\Transparencia\Resources\LicitacaoResource\Pages\ManageDocumentosLicitacao;
use App\Filament\Transparencia\Resources\LicitacaoResource\Pages\ViewLicitacao;
use App\Models\TransparencyBid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicitacaoResource extends Resource
{
    protected static ?string $model = TransparencyBid::class;
    protected static ?string $modelLabel = 'Licitação';
    protected static ?string $pluralModelLabel = 'Licitações';
    protected static ?string $slug = 'licitacoes';
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?int $navigationSort = 3;

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewLicitacao::class,
            EditLicitacao::class,
            ManageDocumentosLicitacao::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detalhes')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('number')
                            ->label('Número'),
                        TextEntry::make('year')
                            ->label('Ano'),
                        TextEntry::make('start_date')
                            ->date()
                            ->label('Data de Abertura'),
                        TextEntry::make('description')
                            ->columnSpanFull()
                            ->label('Objeto'),
                        TextEntry::make('location')
                            ->label('Local da Publicação'),
                        TextEntry::make('link')
                            ->columnSpanFull()
                            ->url(fn($state) => $state)
                            ->color('info')
                            ->openUrlInNewTab()
                            ->label('Link'),
                        TextEntry::make('observation')
                            ->columnSpanFull()
                            ->label('Observação'),
                    ])
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\TextInput::make('number')
                        ->label('Número')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('year')
                        ->label('Ano')
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Data de Abertura')
                        ->required(),
                ]),

                Forms\Components\Textarea::make('description')
                    ->label('Objeto')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Local da Publicação')
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->maxLength(255),
                Forms\Components\Textarea::make('observation')
                    ->label('Observação')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('year', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'licitacao'))
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('Número')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->words(20)->wrap(),
                Tables\Columns\TextColumn::make('hits')
                    ->label('Acessos')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListLicitacao::route('/'),
            'create' => Pages\CreateLicitacao::route('/create'),
            'view' => Pages\ViewLicitacao::route('/{record}'),
            'edit' => Pages\EditLicitacao::route('/{record}/edit'),
            'documentos' => Pages\ManageDocumentosLicitacao::route('/{record}/documentos')
        ];
    }
}

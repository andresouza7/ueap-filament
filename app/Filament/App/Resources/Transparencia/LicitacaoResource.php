<?php

namespace App\Filament\App\Resources\Transparencia;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages\ListLicitacao;
use App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages\CreateLicitacao;
use App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages;
use App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages\EditLicitacao;
use App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages\ManageDocumentosLicitacao;
use App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages\ViewLicitacao;
use App\Models\TransparencyBid;
use Filament\Forms;
use Filament\Infolists\Components\TextEntry;
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
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 1;

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewLicitacao::class,
            EditLicitacao::class,
            ManageDocumentosLicitacao::class,
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make([
                    Flex::make([
                        TextInput::make('number')
                            ->label('Número')
                            ->maxLength(255),
                        TextInput::make('year')
                            ->label('Ano')
                            ->maxLength(255),
                        DatePicker::make('start_date')
                            ->label('Data de Abertura')
                            ->required(),
                    ]),

                    Textarea::make('description')
                        ->label('Objeto')
                        ->required(),
                    TextInput::make('location')
                        ->label('Local da Publicação')
                        ->maxLength(255),
                    TextInput::make('link')
                        ->maxLength(255),
                    Textarea::make('observation')
                        ->label('Observação')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('year', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'licitacao'))
            ->columns([
                TextColumn::make('number')
                    ->label('Número')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->words(20)->wrap(),
                TextColumn::make('hits')
                    ->label('Acessos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
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
            'index' => ListLicitacao::route('/'),
            'create' => CreateLicitacao::route('/create'),
            'view' => ViewLicitacao::route('/{record}'),
            'edit' => EditLicitacao::route('/{record}/edit'),
            'documentos' => ManageDocumentosLicitacao::route('/{record}/documentos')
        ];
    }
}

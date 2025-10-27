<?php

namespace App\Filament\App\Resources\Transparencia\Contratos;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\ListContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\CreateContrato;
use App\Filament\App\Resources\Transparencia\ContratoResource\Pages;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\EditContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\ManageDocumentosContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\ViewContrato;
use App\Models\TransparencyBid;
use Filament\Forms;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratoResource extends Resource
{
    protected static ?string $model = TransparencyBid::class;
    protected static ?string $modelLabel = 'Contrato';
    protected static ?string $slug = 'contratos';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-check';
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 3;

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewContrato::class,
            EditContrato::class,
            ManageDocumentosContrato::class,
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make([


                    Flex::make([
                        Select::make('person_type')
                            ->label('Tipo de Pessoa')
                            ->options([
                                'juridica' => 'JURÍDICA',
                                'fisica' => 'FÍSICA'
                            ]),
                        TextInput::make('number')
                            ->label('Número')
                            ->maxLength(255),
                        TextInput::make('year')
                            ->label('Ano')
                            ->maxLength(255),
                        DatePicker::make('start_date')
                            ->label('Data de Abertura')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Data Final')
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
                        ->label('Observação'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('year', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'contrato'))
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
                // Tables\Actions\ViewAction::make(),
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
            'index' => ListContrato::route('/'),
            'create' => CreateContrato::route('/create'),
            'view' => ViewContrato::route('/{record}'),
            'edit' => EditContrato::route('/{record}/edit'),
            'documentos' => ManageDocumentosContrato::route('/{record}/documentos'),
        ];
    }
}

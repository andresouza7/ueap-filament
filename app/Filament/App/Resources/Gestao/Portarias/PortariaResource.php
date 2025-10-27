<?php

namespace App\Filament\App\Resources\Gestao\Portarias;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use App\Filament\App\Resources\Gestao\Portarias\Pages\ListPortarias;
use App\Filament\App\Resources\Gestao\Portarias\Pages\CreatePortaria;
use App\Filament\App\Resources\Gestao\Portarias\Pages\EditPortaria;
use App\Filament\App\Resources\Gestao\PortariaResource\Pages;
use App\Filament\App\Resources\Gestao\PortariaResource\RelationManagers;
use App\Models\Portaria;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PortariaResource extends Resource
{
    protected static ?string $model = Portaria::class;
    protected static ?string $modelLabel = 'Portaria';
    protected static ?string $pluralModelLabel = 'Portarias';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNot('origin', 'CONSU');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(self::getPortariaForm());
    }

    public static function table(Table $table): Table
    {
        return self::getPortariaTable($table);
    }

    public static function getPortariaForm()
    {
        return [
            Section::make([
                TextInput::make('number')
                    ->label('Número')
                    ->required()
                    ->numeric(),
                TextInput::make('year')
                    ->label('Ano')
                    ->required()
                    ->numeric(),
                TextInput::make('subject')
                    ->label('Assunto')
                    ->required()
                    ->maxLength(255),
                TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('created_at')
                    ->label('Data'),
                TextInput::make('origin')
                    ->hidden(fn() => Auth::user()->hasRole('consu'))
                    ->label('Origem')
                    ->maxLength(255),
                FileUpload::make('file')
                    ->columnSpanFull()
                    ->label('Arquivo')
                    ->directory('documents/ordinances')
                    ->acceptedFileTypes(['application/pdf'])
                    ->previewable(false)
                    ->maxFiles(1)
                    ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),

                Select::make('persons')
                    ->columnSpanFull()
                    ->label('Servidores')
                    ->relationship(
                        name: 'persons',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->whereHas('user', fn($q) => $q->whereNotNull('enrollment'))
                    )
                    ->multiple()
                    ->searchable()
                    ->preload(),
            ])->columns(2)
        ];
    }

    public static function getPortariaTable(Table $table)
    {
        return $table
            ->defaultSort(fn($query) => $query->orderBy('year', 'desc')->orderBy('number', 'desc'))
            ->columns([
                // Tables\Columns\TextColumn::make('id')->searchable(),
                TextColumn::make('number')
                    ->label('Nº')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Assunto/Descrição')
                    ->limit(70)
                    ->formatStateUsing(function ($state, $record) {
                        return sprintf("%s - %s", $record->subject, $state);
                    })
                    ->searchable(),
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
                TextColumn::make('origin')
                    ->label('Origem')
                    ->limit(30)
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
                Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
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
            'index' => ListPortarias::route('/'),
            'create' => CreatePortaria::route('/create'),
            // 'view' => Pages\ViewDocumentOrdinance::route('/{record}'),
            'edit' => EditPortaria::route('/{record}/edit'),
        ];
    }
}

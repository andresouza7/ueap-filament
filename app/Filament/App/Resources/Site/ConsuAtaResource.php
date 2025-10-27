<?php

namespace App\Filament\App\Resources\Site;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\ConsuAtaResource\Pages\ListConsuAtas;
use App\Filament\App\Resources\Site\ConsuAtaResource\Pages\CreateConsuAta;
use App\Filament\App\Resources\Site\ConsuAtaResource\Pages\EditConsuAta;
use App\Filament\App\Resources\Site\ConsuAtaResource\Pages;
use App\Filament\App\Resources\Site\ConsuAtaResource\RelationManagers;
use App\Models\ConsuAta;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsuAtaResource extends Resource
{
    protected static ?string $model = ConsuAta::class;

    protected static ?string $modelLabel = 'Ata';

    protected static ?string $slug = 'atas';

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make([

                    TextInput::make('issuer')
                        ->label('Emissor')
                        ->required(),
                    DatePicker::make('issuance_date')
                        ->label('Data da Emissão')
                        ->required(),
                    TextInput::make('title')
                        ->label('Título')
                        ->required(),
                    Textarea::make('description')
                        ->label('Descrição'),

                    FileUpload::make('file')
                        ->label('Arquivo PDF')
                        ->required()
                        ->directory('documents/atas')
                        ->acceptedFileTypes(['application/pdf'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('issuance_date', 'desc')->orderBy('id', 'desc'))
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Nome')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(),
                TextColumn::make('issuer')
                    ->label('Emissor')
                    ->searchable(),
                TextColumn::make('issuance_date')
                    ->label('Data Emissão')
                    ->date('d/m/y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => ListConsuAtas::route('/'),
            'create' => CreateConsuAta::route('/create'),
            'edit' => EditConsuAta::route('/{record}/edit'),
        ];
    }
}

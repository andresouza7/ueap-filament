<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\PortariaResource\Pages;
use App\Filament\App\Resources\Gestao\PortariaResource\RelationManagers;
use App\Models\Portaria;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PortariaResource extends Resource
{
    protected static ?string $model = Portaria::class;
    protected static ?string $modelLabel = 'Portaria';
    protected static ?string $pluralModelLabel = 'Portarias';
    protected static ?string $navigationGroup = 'Gestão';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\TextInput::make('number')
                        ->label('Número')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('year')
                        ->label('Ano')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('subject')
                        ->label('Assunto')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('description')
                        ->label('Descrição')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('created_at')
                        ->label('Data'),
                    Forms\Components\TextInput::make('origin')
                        ->hidden(fn() => auth()->user()->hasRole('consu'))
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

                    Forms\Components\Select::make('persons')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort(fn($query) => $query->orderBy('year', 'desc')->orderBy('number', 'desc'))
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->hasRole('consu')) {
                    $query->where('origin', 'CONSU');
                } else {
                    $query->whereNot('origin', 'CONSU');
                }

                return $query->orderBy('year', 'DESC')->orderBy('number', 'DESC');
            })
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Nº')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Assunto/Descrição')
                    ->limit(70)
                    ->formatStateUsing(function ($state, $record) {
                        return sprintf("%s - %s", $record->subject, $state);
                    })
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('origin')
                    ->label('Origem')
                    ->limit(30)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
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
            'index' => Pages\ListPortarias::route('/'),
            'create' => Pages\CreatePortaria::route('/create'),
            // 'view' => Pages\ViewDocumentOrdinance::route('/{record}'),
            'edit' => Pages\EditPortaria::route('/{record}/edit'),
        ];
    }
}

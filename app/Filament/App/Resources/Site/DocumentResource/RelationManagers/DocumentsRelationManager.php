<?php

namespace App\Filament\Resources\DocumentCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->label('Nome')
                    ->required(),
                TextInput::make('description')
                    ->label('Descrição')
                    ->required(),
                TextInput::make('year')
                    ->label('Ano')
                    ->integer()
                    ->required(),
                FileUpload::make('file')
                    ->label('Arquivo')
                    ->directory('documents/general')
                    ->acceptedFileTypes(['application/pdf'])
                    ->previewable(false)
                    ->maxFiles(1)
                    ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),
                FileUpload::make('thumb')
                    ->visible(fn() => $this->getOwnerRecord()->slug === 'clube-vantagens')
                    ->label('Imagem')
                    ->directory('clube')
                    ->acceptedFileTypes(['image/jpeg'])
                    ->previewable(false)
                    ->maxFiles(1)
                    ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.jpg'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Gerenciar documetos')
            // ->description('kjlklj')
            ->recordTitleAttribute('title')
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(60)
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color('gray')
                    ->label('Tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Criar Documento')
                    ->mutateFormDataUsing(function (array $data) {
                        $data['user_created_id'] = auth()->id();
                        $data['uuid'] = Str::uuid();
                        $data['type'] = $this->getOwnerRecord()->slug;
                        $data['status'] = 'published';

                        return $data;
                    })
                    ->after(function (Model $record, array $data) {
                        $record->storeFileWithModelId($record, $data['file'], 'documents/general');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

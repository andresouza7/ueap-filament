<?php

namespace App\Filament\App\Resources\Site\Documents\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->label('Nome')
                    ->required(),
                TextInput::make('description')
                    ->label('Descrição'),
                Select::make('type')
                    ->label('Tipo')
                    ->visible(fn() => auth()->user()->hasRole('dinfo'))
                    ->options(fn() => \App\Models\Document::query()->distinct()->pluck('type', 'type')->all())
                    ->searchable()
                    ->preload(),

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
            ->recordTitleAttribute('title')
            ->defaultSort('id', 'desc')
            ->recordAction(null)
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->visible(fn() => auth()->user()->hasRole('dinfo')),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->formatStateUsing(fn($state, $record) => new HtmlString("
                        <div>{$state}</div>
                        <div class='text-xs text-gray-500'>{$record->file_url}</div>
                    ")),
                TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('type')
                //     ->badge()
                //     ->color('secondary')
                //     ->label('Tipo')
                //     ->searchable(),
                TextColumn::make('user_created.login')->label('Publicado por'),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Criar Documento')
                    ->mutateDataUsing(function (array $data) {
                        $data['user_created_id'] = Auth::id();
                        $data['uuid'] = Str::uuid();
                        $data['type'] = $this->getOwnerRecord()->slug;
                        $data['status'] = 'published';

                        return $data;
                    })
                    ->after(function (Model $record, array $data) {
                        $record->storeFileWithModelId($data['file'], 'documents/general');
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(fn($record) => \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'update', class_basename($record) . ":{$record->id}")),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
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
}

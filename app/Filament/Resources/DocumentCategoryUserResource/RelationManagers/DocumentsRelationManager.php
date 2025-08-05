<?php

namespace App\Filament\Resources\DocumentCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                TextInput::make('year')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('arquivo')
                    ->collection(fn() => $this->getOwnerRecord()->slug)->openable(),

                Group::make()
                    ->schema(function (Get $get) {
                        $category = $this->getOwnerRecord()->slug;

                        return match ($category) {
                            'consu-atas' => [
                                TextInput::make('metadata.number')->label('Número')->numeric()->required(),
                            ],
                            'consu-resolucoes' => [
                                TextInput::make('metadata.issuer')->label('Emissor'),
                                DatePicker::make('metadata.issuance_date')->label('Data de Emissão'),
                            ],
                            // Add other cases here...
                            default => [],
                        };
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
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
                    ->label('Tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data) {
                        $data['user_created_id'] = auth()->id();
                        $data['uuid'] = Str::uuid();
                        $data['type'] = $this->getOwnerRecord()->slug;
                        $data['status'] = 'published';

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn($record) => $record->getFirstMediaUrl($this->getOwnerRecord()->slug)) // document collection
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->getFirstMediaUrl($this->getOwnerRecord()->slug) !== '')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

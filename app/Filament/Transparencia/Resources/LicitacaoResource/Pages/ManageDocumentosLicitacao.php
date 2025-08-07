<?php

namespace App\Filament\Transparencia\Resources\LicitacaoResource\Pages;

use App\Filament\Transparencia\Resources\LicitacaoResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageDocumentosLicitacao extends ManageRelatedRecords
{
    protected static string $resource = LicitacaoResource::class;
    protected static ?string $title = 'Gerenciar Anexos';
    protected static string $relationship = 'documents';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Anexos';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->heading(fn() => 'Licitação ' . $this->getOwnerRecord()->number)
            ->description('Gerencie os documentos desta licitação')
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->label('Data Publicação'),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->label('Autor'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Publicar Anexo')
                    ->modalHeading('Publicar Anexo')
                    ->modalDescription('Forneça uma descrição e faça o upload do arquivo')
                    ->form([
                        TextInput::make('description')
                            ->label('Descrição')
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('file')
                            ->label('Arquivo')
                            ->previewable(false)
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxFiles(1)
                            ->helperText('Formato pdf')
                    ])
                    ->mutateFormDataUsing(function (array $data) {
                        $data['uuid'] = Str::uuid();
                        $data['user_created_id'] = auth()->id();
                        $data['hits'] = 0;
                        $data['transparency_bid_id'] = $this->getOwnerRecord()->id;

                        return $data;
                    }),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Abrir')
                    ->url(fn($record) => $record->getFirstMediaUrl())
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DissociateBulkAction::make(),
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}

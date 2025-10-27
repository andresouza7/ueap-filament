<?php

namespace App\Filament\Resources\Gestao\HealthAppointments\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class HealthAppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('user.person.name')
                    ->label('Servidor')
                    ->searchable(),
                TextColumn::make('agent_role')
                    ->label('Especialidade')
                    ->searchable(),
                TextColumn::make('requested_date')
                    ->label('Data Atendimento')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('update')
                    ->label('Atualizar Orientações')
                    ->modalDescription('Atualize aqui o arquivo com as orientações')
                    ->schema([
                        FileUpload::make('file')
                            ->acceptedFileTypes(['application/pdf'])
                            ->previewable(false)
                            ->maxFiles(1)
                    ])
                    ->action(function (array $data) {
                        if (!empty($data['file'])) {
                            $filePath = $data['file'];
                            $storagePath = 'politica-saude.pdf';

                            Storage::move($filePath, $storagePath);
                        }

                        Notification::make()
                            ->title('Arquivo salvo com sucesso!')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\App\Resources\Gestao\Users\Pages;

use Filament\Actions\Action;
use App\Filament\App\Resources\Gestao\Users\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
            // Actions\ForceDeleteAction::make(),
            // Actions\RestoreAction::make(),
            Action::make('activateUser')
                ->visible(fn($record) => $record->isActive())
                ->label('Habilitar Usuário')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->resetPassword();

                    Notification::make()
                        ->title('Operação concluída')
                        ->body('Usuário habilitado com sucesso!')
                        ->success()
                        ->send();
                })
                ->icon('heroicon-s-check')
                ->color('success'),
            Action::make('deactivateUser')
                ->hidden(fn($record) => $record->isActive())
                ->label('Desativar Usuário')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->setInactive();

                    Notification::make()
                        ->title('Operação concluída')
                        ->body('Usuário inativado com sucesso!')
                        ->success()
                        ->send();
                })
                ->icon('heroicon-s-no-symbol')
                ->color('danger'),
            Action::make('resetPassword')
                ->label('Resetar Senha')
                ->action(function () {
                    $this->record->resetPassword();

                    // Notify the user of the password reset
                    Notification::make()
                        ->title('Operação concluída')
                        ->body('Senha resetada com sucesso!')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->icon('heroicon-s-key')
                ->modalHeading('Confirmar redefinição da senha')
                ->modalDescription('O usuário será deslogado de qualquer sessão ativa e sua senha padrão será redefinida para o seu CPF.')
                ->color('warning'),
        ];
    }
}

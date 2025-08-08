<?php

namespace App\Filament\App\Resources\Gestao\UserResource\Pages;

use App\Filament\App\Resources\Gestao\UserResource;
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
            Actions\Action::make('resetPassword')
                ->label('Resetar Senha')
                ->action(function (User $record) {
                    // Get the related person's cpf_cnpj value
                    $cpfCnpj = $record->person->cpf_cnpj;

                    // Generate a new hashed password
                    $newPassword = Hash::make($cpfCnpj);

                    // Update the user's password
                    $record->update(['password' => $newPassword]);

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
                ->color('danger'),
        ];
    }
}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
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
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
            Actions\Action::make('resetPassword')
                ->label('Reset Password')
                ->action(function (User $record) {
                    // Get the related person's cpf_cnpj value
                    $cpfCnpj = $record->person->cpf_cnpj;

                    // Generate a new hashed password
                    $newPassword = Hash::make($cpfCnpj);

                    // Update the user's password
                    $record->update(['password' => $newPassword]);

                    // Notify the user of the password reset
                    Notification::make()
                        ->title('Password Reset')
                        ->body('The password has been reset successfully.')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->icon('heroicon-s-key')
                ->modalHeading('Confirm Password Reset')
                ->modalDescription('Are you sure you want to reset the password for this user?')
                ->color('danger'),
        ];
    }
}

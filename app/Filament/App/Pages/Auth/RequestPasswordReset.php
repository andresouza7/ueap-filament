<?php

namespace App\Filament\Candidato\Pages\Auth;

use Filament\Schemas\Schema;
use Exception;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\ResetPasswordNotification;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Schemas\Components\Text;

class RequestPasswordReset extends \Filament\Auth\Pages\PasswordReset\RequestPasswordReset
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Text::make(new \Illuminate\Support\HtmlString('
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-white/10 dark:bg-white/5">
                        <div class="flex items-center gap-3">
                            <div class="text-primary-600 dark:text-primary-400">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                Atenção!
                            </h3>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Um link de redefinição será enviado para seu email institucional. É necessário que ele esteja cadastrado e atualizado. Caso contrário, entre em contato com a URH. 
                            <br> 
                            <span class="inline-flex items-center gap-1 mt-1 font-medium text-primary-600 dark:text-primary-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                urh@ueap.edu.br
                            </span>
                        </p>
                    </div>
                ')),
            $this->getEmailFormComponent()
        ]);
    }

    public function request(): void
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/password-reset/request-password-reset.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/password-reset/request-password-reset.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/password-reset/request-password-reset.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return;
        }

        $data = $this->form->getState();
        $status = Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
            $data,
            function (CanResetPassword $user, string $token): void {
                if (! method_exists($user, 'notify')) {
                    $userClass = $user::class;
                    throw new Exception("Model [{$userClass}] does not have a [notify()] method.");
                }

                $notification = new ResetPasswordNotification($token);
                $user->notify($notification);
            },
        );

        if ($status !== Password::RESET_LINK_SENT) {
            Notification::make()
                ->title(__($status))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(__($status))
            ->success()
            ->send();

        $this->form->fill();
    }
}

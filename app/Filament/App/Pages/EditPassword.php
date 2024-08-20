<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class EditPassword extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    protected static string $view = 'filament.app.pages.password';
    protected static ?string $title = 'Alterar Senha';
    protected static ?string $navigationGroup = 'Minha Área';
    protected static ?int $navigationSort = 5;

    public ?array $data = [];
    public ?User $record = null;

    public function mount(): void
    {
        $this->record = Auth::user();
        $this->fillForm();
    }

    public function fillForm(): void
    {
        $data = $this->record->attributesToArray();
        $this->form->fill($data);
    }

    public function save()
    {
        $data = $this->form->getState();

        // Validate the current password
        if (!Hash::check($data['current_password'], $this->record->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'A senha atual está incorreta.',
            ]);
        }

        // Update the password
        $this->record->forceFill([
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(60),
        ])->save();

        // Reauthenticate user
        Auth::guard('web')->login($this->record, true);

        // Emit notification
        $this->getSavedNotification()?->send();
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Senha atualizada com sucesso!')
            ->success();
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->columns(2)
            ->schema([
                // Forms\Components\TextInput::make('current_password')
                //     ->label('Senha Atual')
                //     ->password()
                //     ->revealable()
                //     ->required()
                //     ->rules([
                //         fn(): Closure => function (string $attribute, $value, Closure $fail) {
                //             if (!Hash::check($value, Auth::user()->password)) {
                //                 $fail('A senha atual está incorreta.');
                //             }
                //         }
                //     ]),
                Forms\Components\TextInput::make('password')
                    ->label('Nova Senha')
                    ->password()
                    ->revealable()
                    ->required(),
                Forms\Components\TextInput::make('confirm_password')
                    ->label('Confirmar Senha')
                    ->password()->password()->same('password')
                    ->revealable()
                    ->required(),

            ])
            ->model($this->record)
            ->statePath('data')
            ->operation('edit');
    }
}

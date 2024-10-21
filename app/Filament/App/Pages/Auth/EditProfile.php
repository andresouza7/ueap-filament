<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Auth;

class EditProfile extends BaseEditProfile
{

    public function getRedirectUrl(): ?string
    {
        return route('filament.app.pages.dashboard');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('username')
                //     ->required()
                //     ->maxLength(255),
                // $this->getNameFormComponent(),
                // $this->getEmailFormComponent(),

                Group::make([
                    TextInput::make('login')
                        ->autocomplete(false)
                        ->required(),
                    TextInput::make('enrollment')
                        ->autocomplete(false)
                        ->label('Matrícula'),
                ]),

                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}

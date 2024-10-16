<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrequencySignature extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $user = Auth::user();

        $this->form->fill([
            'signature_url' => $user->signature_url
        ]);
    }

    public function create() {
        // Retrieve the form data
        $formData = $this->form->getState();

        $user = Auth::user();
        dd($formData);

        // If there's a file uploaded, save it to the user model
        if (isset($formData['signature_url'])) {
            $this->model->addMedia($formData['signature_url']);
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('login'),
            SpatieMediaLibraryFileUpload::make('signature_url')
                ->label('Arquivo da assinatura')
                ->helperText('*formato .jpg apenas')
                ->collection('signaturesxxxxx')
                ->openable()
                ->previewable()
        ])->statePath('data');
    }

    public function render()
    {
        return view('livewire.frequency-signature');
    }
}

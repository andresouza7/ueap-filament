<?php

namespace App\Livewire;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Console\View\Components\Info;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FrequencySignature extends Component implements HasForms
{
    use InteractsWithForms;

    public $model;
    public $signature_url;

    public function mount()
    {
        $this->model = Auth::user();
        $this->form->fill([
            'signature_url' => $this->model->signature_url
        ]);
    }

    public function create() {
        
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('signature_url')
                ->label('Arquivo da assinatura')
                ->helperText('*formato .jpg apenas')
                ->collection('signatures')
                ->image()
                ->deletable()
        ])
        ->model($this->model)
        ->statePath('signature_url');
    }

    public function render()
    {
        return view('livewire.frequency-signature');
    }
}

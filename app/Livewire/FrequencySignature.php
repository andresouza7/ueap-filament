<?php

namespace App\Livewire;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FrequencySignature extends Component implements HasForms
{
    use InteractsWithForms;

    public $model;
    public $attachment; // Arquivo temporário

    public function mount()
    {
        $this->model = Auth::user();
        $this->form->fill([
            'attachment' => $this->model->signature_url ?? null
        ]);
    }

    public function saveSignature()
    {
        $data = $this->form->getState();

        if (true) {
      
            // Notificação de sucesso
            Notification::make()
                ->title('Assinatura cadastrada com sucesso.')
                ->success()
                ->send();

            // Redireciona após salvar
            return redirect()->route('filament.app.pages.print-frequency');
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->model($this->model)
            ->schema([
                Section::make([
                    FileUpload::make('attachment')
                        ->label('Arquivo')
                        ->directory('signatures')
                        ->uploadingMessage('Fazendo upload...')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg'])
                        ->imageEditor()
                        ->maxSize(1024 * 10)
                        ->previewable(false)
                        ->helperText('*Salve as alterações para concluir.')
                        ->getUploadedFileNameForStorageUsing(
                            fn(TemporaryUploadedFile $file, $record): string => "{$record->uuid}.{$file->getClientOriginalExtension()}"
                        ),
                    Actions::make([
                        Action::make('salvar')
                            ->label('Salvar')
                            ->action('saveSignature'),
                    ]),
                ])
                    // ->heading('Configurar Assinatura')
                    ->description('Carregue uma imagem da sua assinatura para usar na folha de ponto.')
            ])
            ->statePath('attachment');
    }

    public function render()
    {
        return view('livewire.frequency-signature');
    }
}

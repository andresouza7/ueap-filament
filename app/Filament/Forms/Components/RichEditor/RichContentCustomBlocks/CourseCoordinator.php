<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class CourseCoordinator extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'course_coordinator';
    }

    public static function getLabel(): string
    {
        return 'Course coordinator';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the course coordinator')
            ->schema([
                //
                TextInput::make('name')
                    ->label('Nome do Coordenador')
                    ->placeholder('Prof. Dr. João da Silva')
                    ->required(),
                TextInput::make('email')
                    ->label('E-mail de Contato')
                    ->placeholder('coordenacao@ueap.edu.br')
                    ->email()
                    ->required(),
                TextInput::make('local')
                    ->label('Local de Atendimento')
                    ->placeholder('Sala 102, Bloco B, Campus I')
                    ->required(),
                TextInput::make('hours')
                    ->label('Horário de Atendimento')
                    ->placeholder('Seg a Sex, 08h às 12h')
                    ->required(),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.course-coordinator.preview', [
            //
            'name' => $config['name'],
            'email' => $config['email'],
            'local' => $config['local'],
            'hours' => $config['hours'],
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.course-coordinator.index', [
            //
            'name' => $config['name'],
            'email' => $config['email'],
            'local' => $config['local'],
            'hours' => $config['hours'],
        ])->render();
    }
}

<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class StaffBlock extends RichContentCustomBlock
{

    public static function getId(): string
    {
        return 'staff';
    }

    public static function getLabel(): string
    {
        return 'Staff';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalHeading('Configurar Corpo Docente')
            ->schema([
                Repeater::make('members')
                    ->label('Membros do Corpo Docente')
                    ->collapsible()
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),
                        TextInput::make('title')
                            ->label('Titulação')
                            ->required(),
                        TextInput::make('regime')
                            ->label('Regime')
                            ->required(),
                        TextInput::make('lattes_url')
                            ->label('URL Currículo Lattes')
                            ->url()
                            ->nullable(),
                    ])
                    ->defaultItems(1)
                    ->minItems(1),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        $members = $config['members'] ?? [];

        return view(
            'filament.forms.components.rich-editor.rich-content-custom-blocks.staff.preview',
            compact('members')
        )->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        // Certifique-se de que a array de membros exista.
        $members = $config['members'] ?? [];

        return view(
            'filament.forms.components.rich-editor.rich-content-custom-blocks.staff.index',
            compact('members')
        )->render();
    }
}

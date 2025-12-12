<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class CurriculumBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'curriculum';
    }

    public static function getLabel(): string
    {
        return 'Estrutura Curricular';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalHeading('Configurar Estrutura Curricular')
            ->schema([
                Repeater::make('semesters')
                    ->label('Semestres')
                    ->collapsible()
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome do Semestre (Ex: 1º Semestre)')
                            ->required(),

                        Repeater::make('subjects')
                            ->label('Disciplinas')
                            ->collapsible()
                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nome da Disciplina')
                                    ->required(),
                                TextInput::make('hours')
                                    ->label('Carga Horária (Ex: 60h)')
                                    ->required(),
                            ])
                            ->defaultItems(1)
                            ->minItems(1),
                    ])
                    ->defaultItems(1)
                    ->minItems(1),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        $semesters = $config['semesters'] ?? [];

        return view(
            'filament.forms.components.rich-editor.rich-content-custom-blocks.curriculum.preview',
            compact('semesters')
        )->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        $semesters = $config['semesters'] ?? [];

        return view(
            'filament.forms.components.rich-editor.rich-content-custom-blocks.curriculum.index',
            compact('semesters')
        )->render();
    }
}

<?php

namespace App\Filament\App\Resources\Gestao\Portarias\Schemas;

use App\Models\Person;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class PortariaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('number')
                        ->label('Número')
                        ->required()
                        ->numeric(),
                    TextInput::make('year')
                        ->label('Ano')
                        ->required()
                        ->numeric(),
                    TextInput::make('subject')
                        ->label('Assunto')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('description')
                        ->label('Descrição')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('created_at')
                        ->label('Data')
                        ->live(),
                    TextInput::make('origin')
                        ->hidden(fn() => Auth::user()->hasRole('consu'))
                        ->label('Origem')
                        ->maxLength(255),

                    FileUpload::make('file')
                        ->columnSpanFull()
                        ->label('Arquivo')
                        ->directory('documents/ordinances')
                        ->acceptedFileTypes(['application/pdf'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),

                    Select::make('persons')
                        ->columnSpanFull()
                        ->label('Servidores')
                        ->helperText('*Servidores interessados e/ou membros de comissão')
                        ->relationship(
                            name: 'persons',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn($query) => $query->whereHas('user', fn($q) => $q->whereNotNull('enrollment'))
                        )
                        ->multiple()
                        ->searchable()
                        ->preload(),

                    self::getImpedimentSection()

                ])->columns(2)
            ]);
    }

    private static function getImpedimentSection()
    {
        return Repeater::make('impediments')
            ->label('Registrar Impedimento')
            ->helperText('**Servidores que respondem a Processo Administrativo Disciplinar ou de Sindicância')
            ->hint('Preencha a data da portaria para registar o impedimento')
            ->disabled(fn(callable $get) => is_null($get('created_at')))
            ->table([
                TableColumn::make('Descrição')
                    ->width('260px')
                    ->markAsRequired(),

                TableColumn::make('Tipo')
                    ->width('120px')
                    ->markAsRequired(),

                TableColumn::make('Início')
                    ->width('120px'),

                TableColumn::make('Fim')
                    ->width('120px'),

                TableColumn::make('Servidores')
                    ->width('200px')
                    ->markAsRequired()
            ])
            ->compact()
            ->columnSpanFull()
            ->schema([
                Textarea::make('description')->required(),
                Select::make('type')
                    ->options([
                        'pad' => 'PAD',
                        'sindicancia' => 'Sindicância'
                    ])
                    ->live()
                    ->required(),
                DatePicker::make('start_date')->readOnly(),
                DatePicker::make('end_date')->readOnly(),

                Select::make('user_id')
                    ->options(
                        fn() => User::with('person')
                            ->orderBy('login')
                            ->get()
                            ->mapWithKeys(fn($user) => [
                                $user->id => $user->person->name ?? '(Sem nome)'
                            ])
                    )
                    ->multiple()
                    ->searchable()
                    ->required()
                    ->required(),
            ])
            ->addActionLabel('Adicionar')
            ->minItems(0)
            ->maxItems(1)
            ->live()
            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                $createdAt = \Carbon\Carbon::parse($get('created_at'));

                foreach ($state as $key => $item) {

                    // Preencher start_date sempre igual ao created_at
                    $set("impediments.$key.start_date", $createdAt->toDateString());

                    // Verifica o tipo
                    $type = $item['type'] ?? null;

                    if ($type === 'sindicancia') {
                        $endDate = $createdAt->clone()->addDays(30);
                    } elseif ($type === 'pad') {
                        $endDate = $createdAt->clone()->addDays(60);
                    } else {
                        // Caso não tenha tipo escolhido ainda
                        $endDate = $createdAt;
                    }

                    $set("impediments.$key.end_date", $endDate->toDateString());
                }
            });
    }
}

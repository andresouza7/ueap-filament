<?php

namespace App\Filament\App\Pages;

use App\Models\CalendarOccurrence;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithHeaderActions;
use Filament\Pages\Page;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PrintFrequency extends Page implements HasTable, HasForms, HasActions
{
    use InteractsWithTable, InteractsWithForms, InteractsWithHeaderActions, InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static string $view = 'filament.app.pages.frequency';
    protected static ?string $title = 'Folha de Ponto';
    protected static ?string $navigationGroup = 'Minha Área';
    protected static ?int $navigationSort = 3;

    public User $requestedUser;
    // Usuário pode preencher campos do formulário
    public bool $canFillFields = false;

    public function mount()
    {
        $signedUser = Auth::user();
        $this->requestedUser = User::findOrFail(request('user') ?? $signedUser->id);

        $isSameUser = $this->requestedUser->id === $signedUser->id;
        $hasPermission = $signedUser->hasAnyRole(['dinfo', 'urh']);

        // Permite acesso apenas se for o próprio usuário ou tiver role especial
        abort_unless(
            $isSameUser || $hasPermission,
            403
        );

        // Pode preencher campos: é o próprio usuário ou usuário especial acessando ele mesmo
        $this->canFillFields = $isSameUser;
    }


    public function table(Table $table): Table
    {
        return $table
            ->heading('Minhas Ocorrências de Ponto')
            ->description('Cadastre e gerencie alterações de expediente na sua folha de ponto.')
            ->recordTitleAttribute('description')
            ->query(CalendarOccurrence::query()->where('user_id', Auth::id())->where('type', 2))
            ->defaultSort('start_date', 'desc')
            ->columns([
                TextColumn::make('description')
                    ->searchable()
                    ->label('Descrição'),
                TextColumn::make('start_date')
                    ->sortable()
                    ->dateTime('d/m/Y')
                    ->label('Data Início'),
                TextColumn::make('end_date')
                    ->sortable()
                    ->dateTime('d/m/Y')
                    ->label('Data Fim'),
            ])
            ->contentGrid([
                'xl' => 1,
            ])
            ->headerActions([
                CreateAction::make()
                    ->recordTitle('Ocorrência de Ponto')
                    // ->recordTitleAttribute('kljlçjl')
                    ->form([
                        Select::make('type')
                            ->options([
                                'FACULTADO',
                                'FALTA',
                                'ATESTADO'
                            ]),
                        TextInput::make('start_date')
                            ->required()
                    ])
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}

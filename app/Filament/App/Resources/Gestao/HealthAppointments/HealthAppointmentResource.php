<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointments;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Carbon\Carbon;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Gestao\HealthAppointments\Pages\ListHealthAppointments;
use App\Filament\App\Resources\Gestao\HealthAppointments\Pages\CreateHealthAppointment;
use App\Filament\App\Resources\Gestao\HealthAppointments\Pages\ViewHealthAppointment;
use App\Filament\App\Resources\Gestao\HealthAppointmentResource\Pages;
use App\Filament\App\Resources\Gestao\HealthAppointmentResource\RelationManagers;
use App\Models\HealthAppointment;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HealthAppointmentResource extends Resource
{
    protected static ?string $model = HealthAppointment::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-heart';

    protected static ?string $modelLabel = 'Saúde e Bem-Estar';
    protected static ?string $pluralModelLabel = 'Saúde e Bem-Estar';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 7;

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->heading('Dados do Agendamento')
                    ->schema([

                        TextEntry::make('user.person.name')
                            ->label('Nome'),
                        TextEntry::make('user.person.birthdate')
                            ->label('Idade')
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->age),
                        TextEntry::make('user.group.name')
                            ->label('Setor'),
                        TextEntry::make('user.person.email')
                            ->label('Email'),
                        TextEntry::make('user.person.phone')
                            ->label('Telefone'),
                        TextEntry::make('user.record.local')
                            ->label('Local de Atendimento'),
                        TextEntry::make('created_at')
                            ->label('Data da Solicitação')
                            ->date('d/m/y H:i'),
                        TextEntry::make('agent_role')
                            ->label('Especialidade')
                            ->badge(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('agent_role')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('requested_date')
                    ->required(),
                Textarea::make('patient_note')
                    ->columnSpanFull(),
                Textarea::make('cancellation_note')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('Novo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('user.person.name')
                    ->label('Servidor')
                    ->searchable(),
                TextColumn::make('agent_role')
                    ->label('Especialidade')
                    ->searchable(),
                TextColumn::make('requested_date')
                    ->label('Data Atendimento')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('update')
                    ->label('Atualizar Orientações')
                    ->modalDescription('Atualize aqui o arquivo com as orientações')
                    ->schema([
                        FileUpload::make('file')
                            ->acceptedFileTypes(['application/pdf'])
                            ->previewable(false)
                            ->maxFiles(1)
                    ])
                    ->action(function (array $data) {
                        if (!empty($data['file'])) {
                            $filePath = $data['file'];
                            $storagePath = 'politica-saude.pdf';

                            Storage::move($filePath, $storagePath);
                        }

                        Notification::make()
                            ->title('Arquivo salvo com sucesso!')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHealthAppointments::route('/'),
            'create' => CreateHealthAppointment::route('/create'),
            'view' => ViewHealthAppointment::route('/{record}'),
            // 'edit' => Pages\EditHealthAppointment::route('/{record}/edit'),
        ];
    }
}

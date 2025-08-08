<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\HealthAppointmentResource\Pages;
use App\Filament\App\Resources\Gestao\HealthAppointmentResource\RelationManagers;
use App\Models\HealthAppointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HealthAppointmentResource extends Resource
{
    protected static ?string $model = HealthAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $modelLabel = 'Saúde e Bem-Estar';
    protected static ?string $pluralModelLabel = 'Saúde e Bem-Estar';
    protected static ?string $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 5;

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->columns(2)
                    ->heading('Dados do Agendamento')
                    ->schema([

                        TextEntry::make('user.person.name')
                            ->label('Nome'),
                        TextEntry::make('user.person.birthdate')
                            ->label('Idade')
                            ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)->age),
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('agent_role')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('requested_date')
                    ->required(),
                Forms\Components\Textarea::make('patient_note')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('cancellation_note')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
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
                Tables\Columns\TextColumn::make('user.person.name')
                    ->label('Servidor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent_role')
                    ->label('Especialidade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('requested_date')
                    ->label('Data Atendimento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListHealthAppointments::route('/'),
            'create' => Pages\CreateHealthAppointment::route('/create'),
            'view' => Pages\ViewHealthAppointment::route('/{record}'),
            // 'edit' => Pages\EditHealthAppointment::route('/{record}/edit'),
        ];
    }
}

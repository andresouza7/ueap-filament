<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\GroupsRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\PersonRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Usuário';

    protected static ?string $navigationGroup = 'Gerência';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tabs\Tab::make('Usuário')
                                    ->columns(2)
                                    ->schema([
                                        // ...
                                        Forms\Components\TextInput::make('email')
                                            ->email()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('login')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('enrollment')
                                            ->hiddenOn('create')
                                            ->label('Matrícula')
                                            ->maxLength(255),
                                        Forms\Components\Select::make('group_id')
                                            ->label('Setor')
                                            ->required()
                                            ->relationship('group', 'description')
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\Select::make('effective_role_id')
                                            ->required()
                                            ->label('Cargo Efetivo')
                                            ->relationship('effective_role', 'description')
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\Select::make('commissioned_role_id')
                                            ->label('Cargo Comissionado')
                                            ->relationship('commissioned_role', 'description')
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\Toggle::make('active')
                                            ->hiddenOn('create')
                                            ->label('Vínculo Ativo')
                                            ->required(),
                                    ]),
                                Tabs\Tab::make('Dados Pessoais')
                                    ->schema([
                                        // ...
                                        Group::make()
                                            ->relationship('person')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nome')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('cpf_cnpj')
                                                    ->rules('cpf')
                                                    ->unique(ignoreRecord: true)
                                                    ->label('CPF')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\DatePicker::make('birthdate')
                                                    ->hiddenOn('create')
                                                    ->label('Data de Nascimento')
                                            ])

                                    ]),
                                Tabs\Tab::make('Registros Funcionais')
                                    ->hiddenOn('create')
                                    ->schema([
                                        // ...
                                        Group::make()
                                            ->relationship('record')
                                            ->schema([
                                                Forms\Components\TextInput::make('ordinance')
                                                    ->label('Doc. de Admissão')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\Select::make('category')
                                                    ->label('Categoria')
                                                    ->options([
                                                        'docente' => 'Docente',
                                                        'técnico' => 'Técnico'
                                                    ]),
                                                Forms\Components\DatePicker::make('ordinance_date')
                                                    ->label('Data do Documento'),
                                                Forms\Components\DatePicker::make('admission_date')
                                                    ->label('Data de Admissão')
                                            ])
                                    ]),
                            ]),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('group.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('login')
                    ->searchable(),
                Tables\Columns\TextColumn::make('enrollment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('effective_role.description')
                    ->sortable(),
                Tables\Columns\TextColumn::make('commissioned_role.description')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_team_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile_photo_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('two_factor_confirmed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gauth_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gauth_type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GroupsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                // SoftDeletingScope::class,
            ]);
    }
}

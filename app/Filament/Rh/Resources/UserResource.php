<?php

namespace App\Filament\Rh\Resources;

use App\Filament\Rh\Resources\UserResource\Pages;
use App\Filament\Rh\Resources\UserResource\RelationManagers\GroupsRelationManager;
use App\Filament\Rh\Resources\UserResource\RelationManagers\PersonRelationManager;
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
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Usuário';

    protected static ?string $navigationGroup = 'RH';

    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                                        Forms\Components\Select::make('roles')
                                            ->label('Permissões')
                                            ->relationship('roles', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload(),
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
                Tables\Columns\TextColumn::make('person.name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('enrollment')
                    ->label('Matrícula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('group.name')
                    ->label('Lotação')
                    ->sortable(),
                Tables\Columns\TextColumn::make('effective_role.description')
                    ->label('Cargo Efetivo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('commissioned_role.description')
                    ->label('Cargo Comissionado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
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
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
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
            // GroupsRelationManager::class
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
        // dd(auth()->user()->getRoleNames());
        // $role = Role::create(['name' => 'test']);
        // auth()->user()->assignRole('test');
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                // SoftDeletingScope::class,
            ]);
    }
}

<?php

namespace App\Filament\App\Resources\Gestao;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Gestao\UserResource\Pages\ListUsers;
use App\Filament\App\Resources\Gestao\UserResource\Pages\CreateUser;
use App\Filament\App\Resources\Gestao\UserResource\Pages\EditUser;
use App\Filament\App\Resources\Gestao\UserResource\Pages;
use App\Filament\App\Resources\Gestao\UserResource\RelationManagers\GroupsRelationManager;
use App\Filament\App\Resources\Gestao\UserResource\RelationManagers\PersonRelationManager;
use App\Livewire\FrequencyEmit;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Servidor';
    protected static ?string $pluralModelLabel = 'Servidores';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tab::make('Usuário')
                                    ->columns(2)
                                    ->schema([
                                        // ...
                                        TextInput::make('email')
                                            ->email()
                                            ->maxLength(255),
                                        TextInput::make('login')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('enrollment')
                                            ->hiddenOn('create')
                                            ->label('Matrícula')
                                            ->maxLength(255),
                                        Select::make('group_id')
                                            ->label('Setor')
                                            ->required()
                                            ->relationship('group', 'description')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('effective_role_id')
                                            ->required()
                                            ->label('Cargo Efetivo')
                                            ->relationship('effective_role', 'description')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('commissioned_role_id')
                                            ->label('Cargo Comissionado')
                                            ->relationship('commissioned_role', 'description')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('roles')
                                            ->label('Permissões')
                                            ->relationship('roles', 'name')
                                            ->multiple()
                                            ->searchable()
                                            ->preload(),
                                    ]),
                                Tab::make('Dados Pessoais')
                                    ->schema([
                                        // ...
                                        Group::make()
                                            ->relationship('person')
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Nome')
                                                    ->required()
                                                    ->maxLength(255),
                                                TextInput::make('cpf_cnpj')
                                                    ->rules('cpf')
                                                    ->unique(ignoreRecord: true)
                                                    ->label('CPF')
                                                    ->required()
                                                    ->maxLength(255),
                                                DatePicker::make('birthdate')
                                                    ->hiddenOn('create')
                                                    ->label('Data de Nascimento')
                                            ])

                                    ]),
                                Tab::make('Registros Funcionais')
                                    ->hiddenOn('create')
                                    ->schema([
                                        // ...
                                        Group::make()
                                            ->relationship('record')
                                            ->columns(2)
                                            ->schema([
                                                TextInput::make('ordinance')
                                                    ->label('Doc. de Admissão')
                                                    ->helperText('Decreto ou Contrato')
                                                    ->required()
                                                    ->maxLength(255),
                                                DatePicker::make('ordinance_date')
                                                    ->label('Data do Documento')
                                                    ->helperText('Da publicação ou assinatura'),
                                                DatePicker::make('admission_date')
                                                    ->label('Data de Admissão')
                                                    ->helperText('Entrada em exercício'),
                                                Select::make('category')
                                                    ->label('Categoria')
                                                    ->options([
                                                        'docente' => 'Docente',
                                                        'técnico' => 'Técnico'
                                                    ]),
                                                Select::make('local')
                                                    ->label('Local')
                                                    ->options([
                                                        'MACAPÁ - AP' => 'MACAPÁ - AP',
                                                        'AMAPÁ - AP' => 'AMAPÁ - AP'
                                                    ]),
                                                Select::make('title')
                                                    ->label('Titulação')
                                                    ->options([
                                                        'ensino médio' => 'ensino médio',
                                                        'técnico' => 'técnico',
                                                        'graduado' => 'graduado',
                                                        'especialista' => 'especialista',
                                                        'mestre' => 'mestre',
                                                        'doutor' => 'doutor',
                                                    ]),
                                            ])
                                    ]),
                            ]),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('login')
            ->columns([
                TextColumn::make('person.name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('group.name')
                    ->label('Lotação')
                    ->sortable(),
                TextColumn::make('effective_role.description')
                    ->label('Cargo Efetivo')
                    ->limit(30)
                    ->sortable(),
                TextColumn::make('commissioned_role.description')
                    ->label('Cargo Comissionado')
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                Action::make('imprimirPonto')
                    ->label('Ponto')
                    ->icon('heroicon-o-document')
                    ->url(fn($record) => route('filament.app.pages.print-frequency', ['user' => $record->id]))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
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

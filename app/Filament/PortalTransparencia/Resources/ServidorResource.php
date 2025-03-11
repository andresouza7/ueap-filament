<?php

namespace App\Filament\PortalTransparencia\Resources;

use App\Filament\PortalTransparencia\Resources\ServidorResource\Pages;
use App\Filament\PortalTransparencia\Resources\ServidorResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class ServidorResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Servidor';
    protected static ?string $pluralModelLabel = 'Servidores';
    protected static ?string $slug = 'servidores';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Institucional';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'person.name';
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->person->name;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('person.name')->label('Nome'),
                TextEntry::make('effective_role.description')->label('Cargo'),
                TextEntry::make('group.description')->label('Setor'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Lista de servidores da UEAP')
            ->description('Utilize os filtros e a ferramenta de pesquisa para localizar uma informação')
            ->defaultSort('login')
            ->columns([
                TextColumn::make('person.name')
                    ->label('Nome')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('effective_role.description')
                    ->label('Cargo')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('group.description')
                    ->label('Setor')
                    ->wrap(),
            ])
            ->filters([
                SelectFilter::make('effective_role_id')
                    ->label('Cargo')
                    ->relationship('effective_role', 'description'),
                SelectFilter::make('group_id')
                    ->label('Setor')
                    ->relationship('group', 'description')
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
            'index' => Pages\ListServidor::route('/'),
            'view' => Pages\ViewServidor::route('/{record}'),
        ];
    }
}

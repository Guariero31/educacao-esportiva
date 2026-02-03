<?php

namespace App\Filament\Resources;

use App\Enums\StatusEscola;
use App\Filament\Resources\EscolaResource\Pages;
use App\Filament\Resources\EscolaResource\RelationManagers;
use App\Models\Escola;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EscolaResource extends Resource
{
    protected static ?string $model = Escola::class;

    protected static ?string $pluralLabel = 'Escolas';

    protected static ?string $label = 'Escola';


    protected static ?string $navigationGroup = 'Administração';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static bool $isScopedToTenant = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detalhes Principais')
                    ->schema([
                        TextInput::make('nome')
                            ->required()
                            ->label('Nome'),
                        TextInput::make('ano')
                            ->required()
                            ->numeric()
                            ->label('Ano'),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('nome')->label('Nome'),
                TextColumn::make('ano')->label('Ano'),
                TextColumn::make('status')
                    ->label('Status'),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\AtividadeEscolaRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEscolas::route('/'),
            'create' => Pages\CreateEscola::route('/create'),
            'edit' => Pages\EditEscola::route('/{record}/edit'),
        ];
    }
}

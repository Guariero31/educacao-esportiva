<?php

namespace App\Filament\Resources;

use App\Enums\Periodo;
use App\Filament\Resources\AtividadeResource\Pages;
use App\Filament\Resources\AtividadeResource\RelationManagers;
use App\Models\Atividade;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use OpenSpout\Reader\CSV\Options;

class AtividadeResource extends Resource
{
    protected static ?string $model = Atividade::class;

    protected static ?string $pluralLabel = 'Atividades';

    protected static ?string $label = 'Atividade';


    protected static ?string $navigationGroup = 'Administração';
    protected static bool $isScopedToTenant = false;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(12)->schema([
                            Forms\Components\TextInput::make('nome')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(12),
                            Select::make('periodo')
                                ->label('Período')
                                ->options(Periodo::toSelectArray())
                                ->required()
                                ->columnSpan([
                                    'sm' => 12,
                                    'xl' => 6
                                ]),
                            Forms\Components\TextInput::make('vagas')
                                ->required()
                                ->numeric()
                                ->maxLength(255)
                                ->columnSpan([
                                    'sm' => 12,
                                    'xl' => 6
                                ]),
                        ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome')
                    ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->date('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAtividades::route('/'),
            'create' => Pages\CreateAtividade::route('/create'),
            'edit' => Pages\EditAtividade::route('/{record}/edit'),
        ];
    }
}

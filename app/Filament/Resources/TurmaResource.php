<?php

namespace App\Filament\Resources;

use App\Enums\DiaSemana;
use App\Filament\Resources\TurmaResource\Pages;
use App\Filament\Resources\TurmaResource\RelationManagers;
use App\Models\EscolaAtividade;
use App\Models\Turma;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;

class TurmaResource extends Resource
{
    protected static ?string $model = Turma::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $tenantOwnershipRelationshipName = "escola";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns([
                        'sm' => 1,
                        'lg' => 2,
                    ])
                    ->schema([
                    TextInput::make('nome')
                        ->required()
                        ->label('Nome da Turma'),
                    Select::make('escola_atividade_id')
                        ->label('Atividade')
                        ->options(
                            EscolaAtividade::query()
                                ->where('escola_id', Filament::getTenant()->id)
                                ->with('atividade')
                                ->get()
                                ->map(function ($item) {
                                    return [
                                        'id' => $item->id,
                                        'nome' => $item->atividade->nome,
                                    ];
                                })
                                ->pluck('nome', 'id')
                                ->toArray()
                        )
                        ->required(),
                ]),
                    Repeater::make('programacoes')
                        ->label('Aulas')
                        ->columnSpanFull()
                        ->columns([
                            'sm' => 1,
                            'lg' => 4,
                        ])
                        ->relationship('programacoes')
                        ->schema([
                            Select::make('dia_semana')
                                ->options(DiaSemana::class)
                                ->required()
                                ->label('Dia da Semana'),
                            TimePicker::make('inicio')
                                ->seconds(false)
                                ->required()
                                ->label('Hora de Início'),
                            TimePicker::make('fim')
                                ->required()
                                ->seconds(false)
                                ->label('Hora de Fim'),
                            TextInput::make('local')
                                ->required()
                                ->label('Local'),
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Turma'),
                Tables\Columns\TextColumn::make('atividade.nome')->label('Atividade'),
                Tables\Columns\TextColumn::make('programacoes.dia_semana')
                    ->label('Dias da Semana')

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
            'index' => Pages\ListTurmas::route('/'),
            'create' => Pages\CreateTurma::route('/create'),
            'edit' => Pages\EditTurma::route('/{record}/edit'),
        ];
    }
}

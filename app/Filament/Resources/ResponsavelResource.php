<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponsavelResource\Pages;
use App\Filament\Resources\ResponsavelResource\RelationManagers;
use App\Models\Responsavel;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResponsavelResource extends Resource
{
    protected static ?string $model = Responsavel::class;

    protected static ?string $pluralLabel = 'Responsáveis';

    protected static ?string $label = 'Responsável';

    protected static ?string $navigationGroup = 'Dados dos Alunos';

    protected static ?string $navigationIcon = 'heroicon-o-check';

    protected static ?string $tenantOwnershipRelationshipName = "escolas";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações Pessoais')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rg')
                            ->label('RG'),
                        Forms\Components\DatePicker::make('rg_data_emissao')
                            ->label('Data de Emissão do RG'),
                        Forms\Components\TextInput::make('rg_orgao_emissor')
                            ->label('Órgão Emissor do RG'),
                        Forms\Components\TextInput::make('rg_uf')
                            ->label('UF/RG'),
                        Forms\Components\TextInput::make('cpf')
                            ->label('CPF'),
                    ]),
                Section::make('Contato')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('celular')
                            ->label('Celular'),
                        Forms\Components\TextInput::make('email')
                            ->label('Email'),
                    ]),
                Section::make('Responsabilidade')
                    ->schema([
                        Forms\Components\TextInput::make('parentesco')
                            ->label('Parentesco')
                            ->columnSpan(3),
                        Forms\Components\Checkbox::make('responsavel_legal')
                            ->label('Responsável Legal')
                            ->columnSpan(3),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')->label('Nome')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')->label('Criado em')->dateTime()
                    ->sortable()
                    ->searchable()
                    ->date('d/m/Y'),
                TextColumn::make('updated_at')->label('Atualizado em')->dateTime()
                    ->sortable()
                    ->searchable()
                    ->date('d/m/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResponsavels::route('/'),
            'create' => Pages\CreateResponsavel::route('/create'),
            'edit' => Pages\EditResponsavel::route('/{record}/edit'),
        ];
    }
}

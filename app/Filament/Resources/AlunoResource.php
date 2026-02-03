<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlunoResource\Pages;
use App\Filament\Resources\AlunoResource\Pages\CreateAluno;
use App\Filament\Resources\AlunoResource\RelationManagers;
use App\Models\Aluno;
use App\Services\AlunoService;
use App\Enums\DiaSemana;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\Cep;

class AlunoResource extends Resource
{
    protected static ?string $model = Aluno::class;

    protected static ?string $pluralLabel = 'Alunos';

    protected static ?string $label = 'Aluno';

    protected static ?string $navigationGroup = 'Dados dos Alunos';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $tenantOwnershipRelationshipName = "escolas";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identificação')->schema([
                    Grid::make(12)->schema([
                        Hidden::make('id'),
                        TextInput::make('numero_matricula')
                            ->afterStateUpdated(function ($state, Set $set, $livewire) {
                                if ($livewire instanceof CreateAluno) {
                                    AlunoService::carregaAluno($state, 'matricula', $set);
                                }
                            })
                            ->label('Número de Matrícula')
                            ->live()
                            ->columnSpan(6),
                        Document::make('cpf')
                            ->label('CPF')
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set, $livewire) {
                                if ($livewire instanceof CreateAluno) {
                                    AlunoService::carregaAluno($state, 'cpf', $set);
                                }
                            })
                            ->cpf()
                            ->columnSpan(6),
                    ])


                ]),
                Section::make('Informações Pessoais')
                    ->disabled()
                    ->schema([
                        TextInput::make('nome')

                            ->label('Nome')
                            ->columnSpan(6),
                        DatePicker::make('nascimento')

                            ->label('Data de Nascimento')
                            ->columnSpan(6),
                        TextInput::make('email')

                            ->label('Email')
                            ->columnSpan(6),
                        TextInput::make('rg')
                            ->label('RG')
                            ->columnSpan(6),
                        DatePicker::make('rg_data_expedicao')
                            ->label('Data de Expedição do RG')
                            ->columnSpan(6),
                        TextInput::make('rg_orgao_expedicao')
                            ->label('Orgão Expedidor do RG')
                            ->columnSpan(6),
                        TextInput::make('certidao_nascimento_numero')
                            ->label('Número da Certidão de Nascimento')
                            ->columnSpan(6),
                        TextInput::make('certidao_nascimento_livro')
                            ->label('Livro da Certidão de Nascimento')
                            ->columnSpan(6),
                        TextInput::make('certidao_nascimento_folha')
                            ->label('Folha da Certidão de Nascimento')
                            ->columnSpan(6),
                        TextInput::make('sexo')
                            ->label('Sexo')
                            ->columnSpan(6),
                        TextInput::make('cor_id')
                            ->label('Cor')
                            ->columnSpan(6),
                        TextInput::make('nome_social')
                            ->label('Nome Social')
                            ->columnSpan(6),
                        TextInput::make('telefone')
                            ->label('Telefone')
                            ->columnSpan(6),
                        TextInput::make('celular')
                            ->label('Celular')
                            ->columnSpan(6),
                        TextInput::make('email_google')
                            ->label('Email Google')
                            ->columnSpan(6),
                        TextInput::make('tipo_sanguineo')
                            ->label('Tipo Sanguíneo')
                            ->columnSpan(6),
                        TextInput::make('codigo_inep')
                            ->label('Código INEP')
                            ->columnSpan(6),

                    ])
                    ->columns(12),
                Section::make('Endereço')
                    ->disabled()
                    ->schema([
                        Cep::make('cep')
                            ->label('CEP')
                            ->columnSpan(6),
                        /*
                            ->viaCep(
                                mode: 'suffix',
                                errorMessage: 'CEP inválido.',
                                setFields: [
                                    'rua' => 'logradouro',
                                    'numero' => 'numero',
                                    'complemento' => 'complemento',
                                    'bairro' => 'bairro',
                                    'cidade' => 'localidade',
                                    'estado' => 'uf'
                                ]
                            ),*/
                        TextInput::make('rua')
                            ->label('Rua')
                            ->columnSpan(6),
                        TextInput::make('numero')
                            ->label('Número')
                            ->columnSpan(6),
                        TextInput::make('bairro')
                            ->label('Bairro')
                            ->columnSpan(6),
                        TextInput::make('cidade')
                            ->label('Cidade')
                            ->columnSpan(6),
                        TextInput::make('estado')
                            ->label('Estado')
                            ->columnSpan(6),
                        TextInput::make('complemento')
                            ->label('Complemento')
                            ->columnSpan(6),
                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->columnSpan(6),
                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->columnSpan(6),
                    ])
                    ->columns(12),
                Section::make('Informações Acadêmicas')
                    ->disabled()
                    ->schema([
                        TextInput::make('escola_codigo')
                            ->label('Código da Escola')
                            ->columnSpan(6),
                        TextInput::make('escola_nome')
                            ->label('Nome da Escola')
                            ->columnSpan(6),
                        /* TextInput::make('status_aluno_id')
                            ->label('Status do Aluno')
                            ->columnSpan(6),*/
                        TextInput::make('numero_nis')
                            ->label('Número do NIS')
                            ->columnSpan(6),
                    ])
                    ->columns(12),
                Section::make('Condições de Saúde')
                    ->disabled()
                    ->schema([
                        Checkbox::make('pne')
                            ->label('Portador de Necessidades Especiais')
                            ->columnSpan('full'),
                        Checkbox::make('diabetico')
                            ->label('Diabético')
                            ->columnSpan('full'),
                        Checkbox::make('deficiente')
                            ->label('Deficiente')
                            ->columnSpan('full'),
                        TextInput::make('deficiencia_id')
                            ->label('ID da Deficiência')
                            ->columnSpan([
                                'sm' => 6,
                                'lg' => 3,
                            ]),
                        TextInput::make('sus')
                            ->label('Número do SUS')
                            ->columnSpan([
                                'sm' => 6,
                                'lg' => 3,
                            ]),
                    ])
                    ->columns([
                        'sm' => 2,
                        'lg' => 4,
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nascimento')
                    ->label('Data de Nascimento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cpf')
                    ->label('CPF')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('nome')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function getRelations(): array
    {
        return [
            RelationManagers\ResponsavelResourceRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlunos::route('/'),
            'create' => Pages\CreateAluno::route('/create'),
            'edit' => Pages\EditAluno::route('/{record}/edit'),
            'view' => Pages\ViewAluno::route('/{record}/view'),
        ];
    }
}

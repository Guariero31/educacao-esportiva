<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfiguracaoResource\Pages\EditConfiguracao;
use App\Models\Configuracao;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConfiguracaoResource extends Resource
{
    protected static ?string $model = Configuracao::class;

    protected static ?string $pluralLabel = 'Configurações';

    protected static ?string $label = 'Configuração';

    protected static ?string $navigationGroup = 'Administração';

    protected static bool $isScopedToTenant = false;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('limite_atividades_aluno')
                        ->required()
                        ->label('Limite de Atividades por Aluno')
                        ->numeric()
                        ->minValue(0),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('limite_atividades_aluno')->label('Limite de Atividades por Aluno'),
                TextColumn::make('created_at')->label('Criado em')->dateTime(),
                TextColumn::make('updated_at')->label('Atualizado em')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]); // Remove as ações em massa (bulk actions) se existirem
    }

    public static function getPages(): array
    {
        return [
            'index' => EditConfiguracao::route('/edit'), // Redireciona diretamente para a página de edição
        ];
    }
}

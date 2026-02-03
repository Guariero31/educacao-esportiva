<?php

namespace App\Filament\Resources\AlunoResource\Pages;

use App\Enums\InscricaoStatus;
use App\Enums\DiaSemana;
use App\Filament\Resources\AlunoResource;
use App\Filament\Resources\TurmaResource\RelationManagers;
use App\Models\Aluno;
use App\Models\EscolaAtividade;
use App\Models\Turma;
use Filament\Facades\Filament;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Support\Colors\Color;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist;

class ViewAluno extends ViewRecord
{
    protected static string $resource = AlunoResource::class;

    protected static string $view = 'filament.resources.aluno.view-aluno';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('matricular')
                ->color(Color::Green)
                ->label('Matricular')
                ->requiresConfirmation()
                ->form([
                    Select::make('atividade')
                        ->live()
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('turma', 'null');
                        })
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
                        ),
                    Select::make('turma')
                        ->live()
                        ->options(function (Get $get) {
                            return Turma::query()->whereHas('escolaAtividade', function (Builder $query) use ($get) {
                                return $query->where('escola_atividades.id', $get('atividade'));
                            })->pluck('turmas.nome', 'turmas.id')->toArray();
                        }),
                ])
                ->action(function ($record, $data) {
//                    TurmaAluno::create(
//                        'aluno_id'=>$record->id,
//                        'turma_id'=>$data['turma']
//                    );
                    Notification::make()
                        ->title('Sucesso!')
                        ->body('Matricula realizada.')
                        ->success()
                        ->send();
                }),
            /*
            Action::make('desativar')
                ->color(Color::Yellow)
                ->label('Desativar')
                ->requiresConfirmation()
                ->visible(function ($record) {
                    if ($record->status->value == InscricaoStatus::ATIVA->value) {
                        return true;
                    }
                    return false;
                })
                ->action(function ($record) {
                    $record->status = InscricaoStatus::INATIVA->value;
                    $record->save();
                    Notification::make()
                        ->title('Sucesso!')
                        ->body('Matricula desativada.')
                        ->success()
                        ->send();
                }),
            Action::make('reativar')
                ->color(Color::Green)
                ->label('Reativar')
                ->requiresConfirmation()
                ->visible(function ($record) {
                    if ($record->status->value == InscricaoStatus::INATIVA->value) {
                        return true;
                    }
                    return false;
                })
                ->action(function ($record) {
                    $record->status = InscricaoStatus::ATIVA->value;
                    $record->save();
                    Notification::make()
                        ->title('Sucesso!')
                        ->body('Matricula Reativada.')
                        ->success()
                        ->send();
                }),
                */
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            //AlunoInscricoes::class,
        ];
    }
//    public function infolist(Infolist $infolist): Infolist
//    {
//        return $infolist
//            ->schema([
//                Section::make()
//                    ->schema([
//                        TextEntry::make('nome')
//                            ->label("Nome:")
//                            ->size(TextEntry\TextEntrySize::Large)
//                            ->icon('heroicon-m-academic-cap')
//                            ->iconColor('primary'),
//                        TextEntry::make('turmas.atividade.nome')
//                            ->label("Atividades:")
//                            ->listWithLineBreaks()
//                            ->bulleted(),
//                        TextEntry::make('escolas.nome')
//                            ->label('Escolas:')
//                            ->listWithLineBreaks()
//                            ->bulleted(),
//                        TextEntry::make('turmas.nome')
//                            ->label('Turmas:')
//                            ->listWithLineBreaks()
//                            ->bulleted(),
//                    ])->columns(4)
//
//            ]);
//
//    }

}

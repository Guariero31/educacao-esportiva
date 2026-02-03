<?php

namespace App\Filament\Resources\MatriculaResource\Pages;

use App\Enums\InscricaoStatus;
use App\Filament\Resources\MatriculaResource;
use App\Filament\Resources\MatriculaResource\Widgets\InscricaoMatriculas;
use Filament\Support\Colors\Color;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMatricula extends EditRecord
{
    protected static string $resource = MatriculaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
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
            ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            InscricaoMatriculas::class
        ];
    }
}

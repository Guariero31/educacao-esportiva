<?php

namespace App\Filament\Resources\EscolaResource\Pages;

use App\Enums\StatusEscola;
use App\Filament\Resources\EscolaResource;
use App\Filament\Resources\EscolaResource\Widgets\EscolaStatus;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;

class EditEscola extends EditRecord
{
    protected static string $resource = EscolaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('desativar')
                ->color(Color::Yellow)
                ->label('Desativar')
                ->requiresConfirmation()
                ->visible(function ($record) {
                    if ($record->status->value == StatusEscola::ATIVA->value) {
                        return true;
                    }
                    return false;
                })
                ->action(function ($record) {
                    $record->status = StatusEscola::INATIVA->value;
                    $record->save();
                    Notification::make()
                        ->title('Sucesso!')
                        ->body('Escola desativada.')
                        ->success()
                        ->send();
                }),
            Action::make('reativar')
                ->color(Color::Green)
                ->label('Reativar')
                ->requiresConfirmation()
                ->visible(function ($record) {
                    if ($record->status->value == StatusEscola::INATIVA->value) {
                        return true;
                    }
                    return false;
                })
                ->action(function ($record) {
                    $record->status = StatusEscola::ATIVA->value;
                    $record->save();
                    Notification::make()
                        ->title('Sucesso!')
                        ->body('Escola Reatiavada.')
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EscolaStatus::class
        ];
    }
}

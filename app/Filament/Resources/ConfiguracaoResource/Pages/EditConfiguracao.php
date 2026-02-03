<?php

namespace App\Filament\Resources\ConfiguracaoResource\Pages;

use App\Filament\Resources\ConfiguracaoResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Configuracao;

class EditConfiguracao extends EditRecord
{
    protected static string $resource = ConfiguracaoResource::class;

    public function mount($record = null): void
    {
        $record = Configuracao::firstOrFail()->getKey(); // Obtém o ID do primeiro registro
        parent::mount($record);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['id'] = 1; // Assegura que o ID é sempre 1
        return $data;
    }
}

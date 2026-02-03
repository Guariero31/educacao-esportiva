<?php

namespace App\Filament\Resources\EscolaResource\Pages;

use App\Enums\StatusEscola;
use App\Filament\Resources\EscolaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEscola extends CreateRecord
{
    protected static string $resource = EscolaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = StatusEscola::ATIVA->value;
        return $data;
    }
}

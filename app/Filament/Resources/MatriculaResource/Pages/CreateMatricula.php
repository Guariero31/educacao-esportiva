<?php

namespace App\Filament\Resources\MatriculaResource\Pages;

use App\Enums\InscricaoStatus;
use App\Filament\Resources\MatriculaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMatricula extends CreateRecord
{
    protected static string $resource = MatriculaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = InscricaoStatus::ATIVA->value;
        return $data;
    }
}

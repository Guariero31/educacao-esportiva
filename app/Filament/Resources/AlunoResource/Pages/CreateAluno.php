<?php

namespace App\Filament\Resources\AlunoResource\Pages;

use App\Filament\Resources\AlunoResource;
use App\Models\Aluno;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Enums\InscricaoStatus;

class CreateAluno extends CreateRecord
{
    protected static string $resource = AlunoResource::class;


    protected function handleRecordCreation(array $data): Model
    {
        $aluno = Aluno::query()->find($data['id']);
        if (!empty($aluno->id)) {
            $tenant = Filament::getTenant();
            $aluno->escolas()->syncWithoutDetaching($tenant->id);
            return $aluno;
        } else {
            Notification::make()
                ->title('Aluno não encontrado')
                ->danger()
                ->send();
            $this->halt();
        }
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = InscricaoStatus::ATIVA->value;
        return $data;
    }
}

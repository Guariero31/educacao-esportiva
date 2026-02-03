<?php

namespace App\Filament\Resources\MatriculaResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InscricaoMatriculas extends BaseWidget
{

    public $record;
    protected function getStats(): array
    {
        return [
            Stat::make('Status', $this->record->status),
            Stat::make('Data criação', $this->record->created_at->format('d/m/Y H:i')),
            Stat::make('Data atualização',$this->record->updated_at->format('d/m/Y H:i')),
        ];
    }
}

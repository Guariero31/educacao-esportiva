<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
 
enum StatusEscola: string implements HasLabel
{
    case ATIVA = 'Ativa';
    case INATIVA = 'Inativa';
   
    
    public function getLabel(): ?string
    {

        return match ($this) {
            self::ATIVA => 'Ativa',
            self::INATIVA => 'Inativa',
        };
    }
}
<?php 

namespace App\Enums;

enum InscricaoStatus: string
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
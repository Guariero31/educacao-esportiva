<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DiaSemana: int implements HasLabel
{
    case DOMINGO = 1;
    case SEGUNDA = 2;
    case TERCA = 3;
    case QUARTA = 4;
    case QUINTA = 5;
    case SEXTA = 6;
    case SABADO = 7;


    public function getLabel(): ?string
    {

        return match ($this) {
            self::DOMINGO => 'Domingo',
            self::SEGUNDA => 'Segunda-feira',
            self::TERCA => 'Terça-feira',
            self::QUARTA => 'Quarta-feira',
            self::QUINTA => 'Quinta-feira',
            self::SEXTA => 'Sexta-feira',
            self::SABADO => 'Sábado',
        };
    }
}

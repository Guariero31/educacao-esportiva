<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Periodo extends Enum
{
    const Manha = 'manhã';
    const Tarde = 'tarde';
    const Noite = 'noite';

    public static function toSelectArray(): array
    {
        return [
            self::Manha => 'Manhã',
            self::Tarde => 'Tarde',
            self::Noite => 'Noite',
        ];
    }

}

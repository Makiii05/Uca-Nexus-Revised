<?php

namespace App\Enums;

enum EnrollmentType: string
{
    case New = 'new';
    case Continuing = 'continuing';
    case Transferee = 'transferee';

    public function label(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Continuing => 'Continuing',
            self::Transferee => 'Transferee',
        };
    }
}

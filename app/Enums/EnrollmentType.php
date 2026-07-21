<?php

namespace App\Enums;

enum EnrollmentType: string
{
    case New = 'new';
    case Transferee = 'transferee';

    public function label(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Transferee => 'Transferee',
        };
    }
}

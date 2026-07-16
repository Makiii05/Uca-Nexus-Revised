<?php

namespace App\Enums;

enum TermType: string
{
    case Semester = 'semester';
    case Trimestral = 'trimestral';
    case Summer = 'summer';

    public function label(): string
    {
        return match ($this) {
            self::Semester => 'Semester',
            self::Trimestral => 'Trimestral',
            self::Summer => 'Summer',
        };
    }
}

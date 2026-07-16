<?php

namespace App\Enums;

enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Active => 'badge-success',
            self::Inactive => 'badge-ghost',
        };
    }
}

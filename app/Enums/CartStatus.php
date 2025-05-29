<?php

namespace App\Enums;

enum CartStatus: int
{
    case ACTIVE = 1;
    case LOCKED = 2;

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }
}

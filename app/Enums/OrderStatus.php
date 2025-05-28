<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING = 1;
    case PROCESSING = 2;
    case COMPLETED = 3;
    case CANCELLED = 4;
    case FAILED = 5;

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }
}

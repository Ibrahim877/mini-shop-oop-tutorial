<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case PENDING = 1;
    case COMPLETED = 2;
    case FAILED = 3;
    case CANCELLED = 4;
    case CASH_ON_DELIVERY = 5;

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }
}

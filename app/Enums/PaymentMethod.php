<?php

namespace App\Enums;

enum PaymentMethod: int
{
    case CARD = 1;
    case CASH_ON_DELIVERY = 2;

    /**
     * @return array
     */
    public static function getMethods(): array
    {
        return array_column(self::cases(), 'value');
    }
}

<?php

namespace app\Enums;

enum CartStatus: int
{
    case ACTIVE = 1;
    case COMPLETED = 2;

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }
}

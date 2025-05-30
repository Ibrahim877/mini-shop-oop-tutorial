<?php

namespace App\Traits;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;

trait OrderHelpers
{
    /**
     * @return bool
     */
    public function isCardPayment(): bool
    {
        return $this->payment_method == PaymentMethod::CARD->value;
    }

    /**
     * @return bool
     */
    public function isCashPayment(): bool
    {
        return $this->payment_method == PaymentMethod::CASH_ON_DELIVERY->value;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status == OrderStatus::PENDING->value;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->payment_status == PaymentStatus::COMPLETED->value;
    }

    /**
     * @return bool
     */
    public function isUnpaid(): bool
    {
        return $this->payment_status == PaymentStatus::PENDING->value;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->status == OrderStatus::CANCELLED->value;
    }
}

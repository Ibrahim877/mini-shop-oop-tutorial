<?php

namespace App\DTOs\Payments;

use App\Models\Order;

readonly class CreatePaymentDTO
{
    public function __construct(
        public Order $order,
        public int   $paymentGatewayId,
    )
    {

    }


    public static function fromRequest(int $paymentGatewayId, Order $order): self
    {
        return new self(
            order: $order,
            paymentGatewayId: $paymentGatewayId
        );
    }
}

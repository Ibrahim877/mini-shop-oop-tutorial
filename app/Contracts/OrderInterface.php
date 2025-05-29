<?php

namespace App\Contracts;

use App\DTOs\Orders\CreateOrderDTO;
use App\Models\Order;

interface OrderInterface
{
    public function createOrder(CreateOrderDTO $data): Order;
}

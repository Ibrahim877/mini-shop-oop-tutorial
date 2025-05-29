<?php

namespace App\Contracts;

use App\Models\Cart;
use App\Models\Order;

interface OrderProductInterface
{
    public function createOrderProducts(Order $order, Cart $cart): void;
}

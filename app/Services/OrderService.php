<?php

namespace App\Services;

use App\Contracts\OrderInterface;
use App\DTOs\Orders\CreateOrderDTO;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;

class OrderService implements OrderInterface
{
    /**
     * @param CreateOrderDTO $data
     * @return Order
     */
    public function createOrder(CreateOrderDTO $data): Order
    {
        $order = new Order();
        $order->user_id = $data->cart->user_id;
        $order->status = OrderStatus::PENDING->value;
        $order->payment_method = $data->paymentMethod;
        $order->payment_status = PaymentStatus::PENDING->value;
        $order->total_price = $data->totalAmount;
        $order->save();

        return $order;
    }
}

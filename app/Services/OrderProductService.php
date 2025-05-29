<?php

namespace App\Services;

use App\Contracts\OrderProductInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderProductService implements OrderProductInterface
{
    /**
     * @param Order $order
     * @param Cart $cart
     * @return void
     */
    public function createOrderProducts(Order $order, Cart $cart): void
    {
        foreach ($cart->products as $product) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->product_id;
            $orderProduct->quantity = $product->quantity;
            $orderProduct->price = $product->price;
            $orderProduct->save();
        }
    }
}

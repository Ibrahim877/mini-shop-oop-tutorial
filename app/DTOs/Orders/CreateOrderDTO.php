<?php

namespace App\DTOs\Orders;

use App\Http\Requests\Orders\StoreRequest;
use App\Models\Cart;

class CreateOrderDTO
{
    public function __construct(
        public Cart  $cart,
        public int   $paymentMethod,
        public float $totalAmount
    )
    {
    }


    /**
     * @param StoreRequest $request
     * @param Cart $cart
     * @param int $totalAmount
     * @return self
     */
    public static function fromRequest(StoreRequest $request, Cart $cart, int $totalAmount): self
    {
        return new self(
            cart: $cart,
            paymentMethod: $request->payment_method,
            totalAmount: $totalAmount
        );
    }
}

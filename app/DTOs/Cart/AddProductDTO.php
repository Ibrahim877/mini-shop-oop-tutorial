<?php

namespace App\DTOs\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;

readonly class  AddProductDTO
{
    public function __construct(
        public Cart  $cart,
        public int   $productId,
        public int   $quantity,
        public float $price
    )
    {

    }

    /**
     * @param Request $request
     * @param Cart $cart
     * @return self
     */

    public static function fromRequest(Request $request, Cart $cart): self
    {
        return new self(
            cart: $cart,
            productId: (int)$request->productId,
            quantity: (int)$request->quantity,
            price: (float)$request->price
        );
    }
}

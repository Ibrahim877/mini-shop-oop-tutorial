<?php

namespace App\DTOs\Carts;

use App\Models\CartProduct;
use Illuminate\Http\Request;

readonly class  UpdateProductDTO
{
    public function __construct(
        public CartProduct $cartProduct,
        public int         $quantity,
    )
    {

    }

    /**
     * @param Request $request
     * @param CartProduct $cartProduct
     * @return self
     */

    public static function fromRequest(Request $request, CartProduct $cartProduct): self
    {
        return new self(
            cartProduct: $cartProduct,
            quantity: (int)$request->quantity,
        );
    }
}

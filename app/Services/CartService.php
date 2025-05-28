<?php

namespace App\Services;

use app\Enums\CartStatus;
use App\Models\Cart;

class CartService
{

    /**
     * @param bool $withProducts
     * @return Cart
     */
    public function getActiveCart(bool $withProducts = false): Cart
    {
        $query = auth()->user()->carts()->where('status', CartStatus::ACTIVE->value);

        $cart = $withProducts
            ? $query->with('cartProducts.product')->first()
            : $query->first();

        return $cart ?? $this->createCart();
    }

    /**
     * @return Cart
     */
    public function createCart(): Cart
    {
        $user = auth()->user();
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->status = CartStatus::ACTIVE->value;
        $cart->save();
        return $cart;
    }
}

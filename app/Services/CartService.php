<?php

namespace App\Services;

use app\Enums\CartStatus;
use App\Models\Cart;

class CartService
{

    /**
     * @return Cart
     */
    public function getActiveCart(): Cart
    {
        $cart = auth()->user()->carts()->where('status', CartStatus::ACTIVE->value)->first();

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

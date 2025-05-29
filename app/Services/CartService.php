<?php

namespace App\Services;

use App\Contracts\CartInterface;
use app\Enums\CartStatus;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartService implements CartInterface
{

    /**
     * @param bool $withProducts
     * @return Cart
     */
    public function getActiveCart(bool $withProducts = false): Cart
    {
        $query = auth()->user()->cart()->where('status', CartStatus::ACTIVE->value);

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

    /**
     * @param int $cartId
     * @return int
     */

    public function getTotalAmount(int $cartId): int
    {
        return (float)DB::table('cart_products')
            ->where('cart_id', $cartId)
            ->select(DB::raw('SUM(price * quantity) as total'))
            ->value('total');
    }
}

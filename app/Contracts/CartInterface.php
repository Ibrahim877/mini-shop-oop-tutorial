<?php

namespace App\Contracts;

use App\Models\Cart;

interface CartInterface
{
    public function getActiveCart(bool $withProducts = false): Cart;

    public function createCart(): Cart;
}

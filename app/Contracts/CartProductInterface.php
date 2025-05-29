<?php

namespace App\Contracts;

use App\DTOs\Carts\AddProductDTO;
use App\DTOs\Carts\UpdateProductDTO;
use App\Models\Cart;
use App\Models\CartProduct;

interface CartProductInterface
{
    public function addProduct(AddProductDTO $data): CartProduct;

    public function createProduct(AddProductDTO $data): CartProduct;

    public function incrementProductQuantity(CartProduct $cartProduct, int $quantity): CartProduct;

    public function updateProductQuantity(UpdateProductDTO $data): CartProduct;

    public function deleteProduct(CartProduct $cartProduct): bool;

    public function deleteAllProducts(Cart $cart): bool;

}

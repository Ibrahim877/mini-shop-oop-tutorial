<?php

namespace App\Services;

use App\DTOs\Cart\AddProductDTO;
use App\DTOs\Cart\UpdateProductDTO;
use App\Models\CartProduct;

class CartProductService
{
    /**
     * @param AddProductDTO $data
     * @return CartProduct
     */
    public function addProduct(AddProductDTO $data): CartProduct
    {
        $cartProduct = $data->cart->cartProducts()
            ->where('product_id', $data->productId)
            ->first();
        return empty($cartProduct) ? $this->createProduct($data) : $this->incrementProductQuantity($cartProduct, $data->quantity);
    }

    /**
     * @param AddProductDTO $data
     * @return CartProduct
     */
    public function createProduct(AddProductDTO $data): CartProduct
    {
        $cartProduct = new CartProduct();
        $cartProduct->cart_id = $data->cart->id;
        $cartProduct->product_id = $data->productId;
        $cartProduct->quantity = $data->quantity;
        $cartProduct->price = $data->price;
        $cartProduct->save();
        return $cartProduct;
    }


    /**
     * @param CartProduct $cartProduct
     * @param int $quantity
     * @return CartProduct
     */
    public function incrementProductQuantity(CartProduct $cartProduct, int $quantity): CartProduct
    {
        $cartProduct->quantity += $quantity;
        $cartProduct->save();
        return $cartProduct;
    }

    /**
     * @param UpdateProductDTO $data
     * @return CartProduct
     */
    public function updateProductQuantity(UpdateProductDTO $data): CartProduct
    {
        $data->cartProduct->quantity = $data->quantity;
        $data->cartProduct->save();
        return $data->cartProduct;
    }

    /**
     * @param CartProduct $cartProduct
     * @return bool
     */
    public function deleteProduct(CartProduct $cartProduct): bool
    {
        return $cartProduct->delete();
    }
}

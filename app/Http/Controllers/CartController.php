<?php

namespace App\Http\Controllers;

use App\DTOs\Cart\AddProductDTO;
use App\DTOs\Cart\UpdateProductDTO;
use App\Http\Requests\Cart\AddProductRequest;
use App\Http\Requests\Cart\DeleteProductRequest;
use App\Http\Requests\Cart\UpdateProductRequest;
use App\Models\CartProduct;
use App\Services\CartProductService;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct(
        protected CartService        $service,
        protected CartProductService $productService,
    )
    {
        parent::__construct();
    }

    /**
     * @param AddProductRequest $request
     * @return JsonResponse
     */
    public function addProduct(AddProductRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $cart = $this->service->getActiveCart();
                $productDTO = AddProductDTO::fromRequest($request, $cart);
                $product = $this->productService->addProduct($productDTO);

                $this->success('Məhsul əlavə edildi');
                $this->res->product = $product;
            });
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param UpdateProductRequest $request
     * @return JsonResponse
     */
    public function updateProduct(UpdateProductRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $cartProduct = CartProduct::find($request->cartProductId);
                $productDTO = UpdateProductDTO::fromRequest($request, $cartProduct);
                $product = $this->productService->updateProductQuantity($productDTO);

                $this->success('Məhsul sayı güncəlləndi');
                $this->res->product = $product;
            });
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param DeleteProductRequest $request
     * @return JsonResponse
     */
    public function removeProduct(DeleteProductRequest $request): JsonResponse
    {
        try {
            $cartProduct = CartProduct::find($request->cartProductId);
            $this->productService->deleteProduct($cartProduct);
            $this->success('Məhsul səbətdən silindi');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @return JsonResponse
     */
    public function showCart(): JsonResponse
    {
        $cart = $this->service->getActiveCart(true);
        return response()->json([
            'cart' => $cart
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function clearCart(): JsonResponse
    {
        try {
            $cart = $this->service->getActiveCart();
            DB::transaction(function () use ($cart) {
                $this->productService->deleteAllProducts($cart);
                $this->success('Səbət təmizləndi');
            });
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }
}

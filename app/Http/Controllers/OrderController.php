<?php

namespace App\Http\Controllers;

use App\Contracts\OrderInterface;
use App\Contracts\OrderProductInterface;
use App\Contracts\PaymentInterface;
use App\DTOs\Orders\CreateOrderDTO;
use App\DTOs\Payments\CreatePaymentDTO;
use App\Enums\PaymentMethod;
use App\Http\Requests\Orders\StoreRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function __construct(
        protected OrderInterface        $service,
        protected OrderProductInterface $productService,
        protected PaymentInterface      $paymentService,
    )
    {
        parent::__construct();
    }


    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $cartService = new CartService();
            $cart = $cartService->getActiveCart();
            $createOrderDTO = CreateOrderDTO::fromRequest($request, $cart, $cartService->getTotalAmount($cart->id));
            DB::transaction(function () use ($createOrderDTO, $cart, $request) {
                $order = $this->service->createOrder($createOrderDTO);
                $this->productService->createOrderProducts($order, $cart);
                if ($request->paymentMethod == PaymentMethod::CARD->value) {
                    $createPaymentDTO = CreatePaymentDTO::fromRequest($request->payment_gateway_id, $order);
                    $paymentIntent = $this->paymentService->createPayment($createPaymentDTO);
                }
            });
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return $this->response();
    }
}

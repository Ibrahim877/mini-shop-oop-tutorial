<?php

namespace App\Providers;

use App\Contracts\CartInterface;
use App\Contracts\CartProductInterface;
use App\Contracts\OrderInterface;
use App\Contracts\OrderProductInterface;
use App\Contracts\PaymentInterface;
use App\Contracts\ProductInterface;
use App\Services\CartProductService;
use App\Services\CartService;
use App\Services\OrderProductService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, ProductService::class);
        $this->app->bind(CartInterface::class, CartService::class);
        $this->app->bind(CartProductInterface::class, CartProductService::class);
        $this->app->bind(OrderInterface::class, OrderService::class);
        $this->app->bind(OrderProductInterface::class, OrderProductService::class);
        $this->app->bind(PaymentInterface::class, PaymentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

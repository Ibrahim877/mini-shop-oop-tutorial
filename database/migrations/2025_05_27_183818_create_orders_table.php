<?php

use App\Enums\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $orderStatuses = OrderStatus::getStatuses();
        $paymentMethods = PaymentMethod::getMethods();
        $paymentStatuses = PaymentStatus::getStatuses();

        Schema::create('orders', function (Blueprint $table) use ($orderStatuses, $paymentMethods, $paymentStatuses) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('tracking_number')->nullable();
            $table->enum('status', $orderStatuses)->default(OrderStatus::PENDING->value);
            $table->enum('payment_method', $paymentMethods)->default(PaymentMethod::CARD->value);
            $table->enum('payment_status', $paymentStatuses)->default(PaymentStatus::PENDING->value);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

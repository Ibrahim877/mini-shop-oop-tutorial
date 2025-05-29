<?php

namespace App\Services;


use App\DTOs\Payments\CreatePaymentDTO;
use App\Enums\PaymentStatus;
use App\Models\Payment;

class PaymentService
{
    /**
     * @param CreatePaymentDTO $data
     * @return Payment
     */
    public function createPayment(CreatePaymentDTO $data): Payment
    {
        $payment = new Payment();
        $payment->order_id = $data->order->id;
        $payment->payment_gateway_id = $data->paymentGatewayId;
        $payment->amount = $data->order->total_price;
        $payment->status = PaymentStatus::PENDING->value;
        $payment->save();
        return $payment;
    }
}

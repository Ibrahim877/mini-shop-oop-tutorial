<?php

namespace App\Contracts;

use App\DTOs\Payments\CreatePaymentDTO;
use App\Models\Payment;

interface PaymentInterface
{
    public function createPayment(CreatePaymentDTO $data): Payment;
}

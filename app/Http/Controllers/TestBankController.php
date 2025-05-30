<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestBankController extends Controller
{
    public function simulatePaymentResponse(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
            'total_price' => 'required|float',
        ]);

        $balance = 100;

        if ($request->total_price <= $balance) {
            return response()->json([
                'transaction_id' => Str::uuid(),
                'status' => true,
                'statusCode' => 200
            ]);
        } else {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Kifayət qədər balans yoxdur'
            ]);
        }
    }
}

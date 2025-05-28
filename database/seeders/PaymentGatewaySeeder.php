<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testEpoint = new PaymentGateway();
        $testEpoint->name = 'Epint';
        $testEpoint->key = 'epoint';
        $testEpoint->is_active = true;
        $testEpoint->is_default = true;
        $testEpoint->save();
    }
}

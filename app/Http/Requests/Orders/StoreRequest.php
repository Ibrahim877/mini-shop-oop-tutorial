<?php

namespace App\Http\Requests\Orders;

use App\Enums\PaymentMethod;
use App\Rules\Orders\CanCreateOrderRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method' => [
                'required',
                Rule::in(PaymentMethod::getMethods()),
                new CanCreateOrderRule()
            ],
            'payment_gateway_id' => 'nullable|integer|exists:payment_gateways,id',
        ];
    }
}

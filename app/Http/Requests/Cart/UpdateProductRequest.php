<?php

namespace App\Http\Requests\Cart;

use app\Enums\CartStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cartProductId' => $this->route('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cartProductId' => [
                'required',
                Rule::exists('cart_products', 'id')
                    ->where(function ($query) {
                        $query->whereHas('cart', function ($q) {
                            $q->where('user_id', auth()->id())
                                ->where('status', CartStatus::ACTIVE->value);
                        });
                    })
            ],
            'quantity' => 'required|integer|min:1',
        ];
    }
}

<?php

namespace App\Rules\Orders;

use App\Enums\CartStatus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CanCreateOrderRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cart = auth()->user()->cart;
        if (empty($cart)) {
            $fail('Səbət tapılmadı');
        } elseif ($cart->status != CartStatus::ACTIVE->value) {
            $fail('Səbət aktiv deyil. Sifariş üçün kilidlənib. Yenidən sifariş istəyi yaradıla bilməz. Cari sifarişi tamamlayın');
        } elseif ($cart->products()->count() == 0) {
            $fail('Səbətdə məhsul yoxdur');
        }
    }
}

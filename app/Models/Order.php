<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Traits\OrderHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use OrderHelpers;

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * @return HasOne
     */
    public function latestPendingPayment(): HasOne
    {
        return $this->payments()
            ->where('status', PaymentStatus::PENDING->value)
            ->latest()
            ->first();
    }
}

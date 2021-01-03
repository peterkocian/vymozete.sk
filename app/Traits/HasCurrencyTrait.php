<?php

namespace App\Traits;

use App\Models\Currency;

trait HasCurrencyTrait
{
    /**
     * Get the currency record associated with the calculation.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

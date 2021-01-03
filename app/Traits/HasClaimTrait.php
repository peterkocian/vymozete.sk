<?php

namespace App\Traits;

use App\Models\Claim;

trait HasClaimTrait
{
    /**
     * Get the claim that owns the calculation.
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}

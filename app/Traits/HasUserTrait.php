<?php

namespace App\Traits;

use App\Models\User;

trait HasUserTrait
{
    /**
     * Get the user that owns the calculation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

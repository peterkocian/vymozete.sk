<?php

namespace App\Models\Front;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'participant';

    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * Get the user record associated with the claim.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

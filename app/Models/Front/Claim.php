<?php

namespace App\Models\Front;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    CONST DEFAULT_STATE_ID = 1;

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount', 'description', 'paymentDueDate'];

    /**
     * Get the claim_type record associated with the claim.
     */
    public function claimType()
    {
        return $this->belongsTo(ClaimType::class);
    }

    /**
     * Get the claim_status record associated with the claim.
     */
    public function claimStatus()
    {
        return $this->belongsTo(ClaimStatus::class);
    }

    /**
     * Get the claim_status record associated with the claim.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the user record associated with the claim.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the debtor record associated with the claim.
     */
    public function debtor()
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Get the creditor record associated with the claim.
     */
    public function creditor()
    {
        return $this->belongsTo(Participant::class);
    }
}

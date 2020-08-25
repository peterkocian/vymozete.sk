<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\Models\Front\ClaimStatus;
use App\Models\Front\ClaimType;
use App\Models\Front\Currency;
use App\Models\Front\Participant;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use DateFormatTrait;
    CONST DEFAULT_STATE_ID = 1;

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = '/admin/claims/';

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

    public function getAmountWithCurrencyAttribute()
    {
        return $this->amount . ' ' . $this->currency->symbol;
    }

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

    /**
     * A claim can have many files
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * A claim can have many notes
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * A claim can have many properties
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}

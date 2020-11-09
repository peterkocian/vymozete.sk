<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use DateFormatTrait;
    const DEFAULT_STATE_ID = 1; //todo iba docasne
    const INDEX_VIEW_PAGINATION = false;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'claims';

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
    protected $fillable = ['amount', 'description', 'payment_due_date'];

    public function getAmountWithCurrencyAttribute()
    {
        return $this->amount . ' ' . $this->currency->symbol;
    }

    public function getDebtorFullNameAttribute()
    {
        return $this->debtor->entity->fullname;
    }

    public function getCreditorFullNameAttribute()
    {
        return $this->creditor->entity->fullname;
    }

    public function getTypeNameAttribute()
    {
        return $this->claimType->translation(\Illuminate\Support\Facades\Auth::user()->language_id)->firstOrFail()->name;
    }

    public function getStatusNameAttribute()
    {
        return $this->claimStatus->translation(\Illuminate\Support\Facades\Auth::user()->language_id)->firstOrFail()->name;
    }

    /**
     * Vzdy ked pristupime ku atributu payment_due_date, tak sa automaticky naformatuje podla tohto formatu
     *
     * @param $value
     * @return false|string
     */
    public function getPaymentDueDateAttribute($value) {
        return date('d.m.Y', strtotime($value));
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
     * Get the currency record associated with the claim.
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
     * A claim can have many calculations
     */
    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }

    /**
     * A claim can have many properties
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * A claim can have many calendar events / splatok
     */
    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
}

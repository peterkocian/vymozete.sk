<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasCurrencyTrait;
use App\Traits\HasUserTrait;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Claim extends Model
{
    use HasDateFormatTrait, HasUserTrait, HasCurrencyTrait;
    const DEFAULT_STATE_ID = 1; //todo iba docasne
    const INDEX_VIEW_PAGINATION = true;
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

    public function getClaimTypeNameAttribute()
    {
        return $this->claimType->available_translation(Auth::user()->language_id)->exists()
            ? $this->claimType->available_translation(Auth::user()->language_id)->firstOrFail()->name
            : $this->claimType->key;
    }

    public function getStatusNameAttribute()
    {
        return $this->claimStatus->available_translation(Auth::user()->language_id)->exists()
            ? $this->claimStatus->available_translation(Auth::user()->language_id)->firstOrFail()->name
            : $this->claimStatus->key;
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

    public function getUrok(): float
    {
        $debtor = $this->debtor;
        $rate = 0;
        $date = 0;

        if ($debtor['entity_type'] === Person::class) {
            $rates = InterestRate::getPersonInterestRates();
        } else {
            $rates = InterestRate::getOrganizationInterestRates();
        }

        foreach ($rates as $rate) {
            if (strtotime($this['payment_due_date']) >= strtotime($rate['date'])) {
                $date = $rate['date'];
                $rate = $rate['coefficient'];
            }
        }

        if ($rate == 0) {
            return 0;
        }

        return $this['amount']
            * ($rate / 100) / 365
            * date_diff(new DateTime($this['payment_due_date']), new DateTime($date), true)->days;
    }

    public function getTrovy(): float
    {
        $fee = 0;
        if ($this->amount >= 0 && $this->amount <= 165.97) {
            $fee = 16.60;
        } elseif ($this->amount > 165.97 && $this->amount <= 663.88) {
            $fee = 16.60;
            $fee += ceil(($this->amount - 165.97) / 33.19) * 1.66;
        } elseif ($this->amount > 663.88 && $this->amount <= 6638.78) {
            $fee = 41.49;
            $fee += ceil(($this->amount - 663.88) / 331.94) * 9.96;
        } elseif ($this->amount > 6638.78 && $this->amount <= 33193.92) {
            $fee = 220.74;
            $fee += ceil(($this->amount - 6638.78) / 1659.70) * 16.60;
        } elseif ($this->amount > 33193.92) {
            $fee = 486.29;
            $fee += ceil(($this->amount - 33193.92) / 3319.39) * 6.64;
        }
        return $fee;
    }

    public function summary()
    {
        return $this->amount + $this->getTrovy() * 1.2 + $this->getUrok();
    }

    public function getVymozene(): float
    {
        return $this->calculations->where('paid',1)->sum('amount');
    }
}

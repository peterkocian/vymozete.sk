<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use DateTime;
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

    public function getUrok(): float
    {
        $debtor = $this->debtor;

        $rates = self::INTEREST_RATES;
        $rate = 0;
        $date = 0;

        foreach ($rates[$debtor['entity_type']] as $d => $r) {
            if (strtotime($this['payment_due_date']) >= strtotime($d)) {
                $rate = $r;
                $date = $d;
            }
        }

        if ($rate == 0) {
            return 0;
        }

        return $this['amount']
            * ($rate / 100) / 365
            * date_diff(new DateTime($this['payment_due_date']), new DateTime($date), true)->days;
    }

    const INTEREST_RATES = [
        Person::class => [
            '2013-02-01' => 5.75,
            '2013-05-08' => 5.50,
            '2013-11-13' => 5.25,
            '2014-06-11' => 5.15,
            '2014-09-10' => 5.05,
            '2015-12-09' => 5.05,
            '2016-03-16' => 5.00,
            '2017-01-01' => 5.00
        ],
        Organization::class => [
            '2009-01-01' => 12.50,
            '2009-01-15' => 10.50,
            '2009-01-21' => 10.00,
            '2009-03-11' => 9.50,
            '2009-04-08' => 9.25,
            '2009-05-13' => 9.00,
            '2011-04-13' => 9.25,
            '2011-07-13' => 9.50,
            '2011-11-09' => 9.25,
            '2011-12-14' => 9.00,
            '2012-07-11' => 8.75,
            '2013-02-01' => 9.75,
            '2013-05-08' => 9.50,
            '2013-11-13' => 9.25,
            '2014-06-11' => 9.15,
            '2014-09-10' => 9.05,
            '2015-01-01' => 8.05,
            '2015-07-01' => 8.05,
            '2016-01-01' => 8.05,
            '2016-03-16' => 8.00,
            '2017-01-01' => 8.00
        ]
    ];
}

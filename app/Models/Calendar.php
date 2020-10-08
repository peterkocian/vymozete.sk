<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
//    use DateFormatTrait;
    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'claims';

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'calendar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'amount', 'claim_id', 'currency_id', 'user_id'];

    public function getAmountWithCurrencyAttribute()
    {
        return $this->amount . ' ' . $this->currency->symbol;
    }

    /**
     * Get the currency record associated with the claim.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Vzdy ked pristupime ku atributu created_at, tak sa automaticky naformatuje podla tohto formatu
     *
     * @param $value
     * @return false|string
     */
//    public function getDateAttribute($value) {
//        return date('d.m.Y', strtotime($value));
//    }

    /**
     * Get the claim_status record associated with the claim.
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}

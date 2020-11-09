<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
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
     * Get the currency record associated with the calendar.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the claim_status record associated with the calendar.
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * Get the user that owns the calendar.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

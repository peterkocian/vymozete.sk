<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasClaimTrait;
use App\Traits\HasCurrencyTrait;
use App\Traits\HasUserTrait;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
//    use DateFormatTrait;
    use HasCurrencyTrait, HasUserTrait, HasClaimTrait;
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
}

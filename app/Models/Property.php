<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\Models\Front\Currency;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use DateFormatTrait;

    const ENTITY_ROUTE_PREFIX = '/admin/claims/';

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'property';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'amount', 'description', 'claim_id', 'currency_id', 'user_id'];

    public function getAmountWithCurrencyAttribute()
    {
        return $this->amount . ' ' . $this->currency->symbol;
    }

    /**
     * Get the claim_status record associated with the claim.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

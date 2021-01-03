<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasClaimTrait;
use App\Traits\HasCurrencyTrait;
use App\Traits\HasUserTrait;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasDateFormatTrait, HasUserTrait, HasCurrencyTrait, HasClaimTrait;

    const ENTITY_ROUTE_PREFIX = 'properties';
    const INDEX_VIEW_PAGINATION = true;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

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

    /**
     * Accessor that compute new attribute amount with currency.
     *
     * @return string
     */
    public function getAmountWithCurrencyAttribute()
    {
        return $this->amount . ' ' . $this->currency->symbol;
    }
}

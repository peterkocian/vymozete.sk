<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use DateFormatTrait;
    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'claims';
    const INDEX_VIEW_PAGINATION = true;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

    const PAID_TRUE = '1';
    const PAID_FALSE = '0';

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'calculation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'amount', 'description', 'paid', 'claim_id', 'currency_id', 'user_id'];

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
    public function getDateAttribute($value) {
        return date('d.m.Y', strtotime($value));
    }

    public function getPaidLabelAttribute()
    {
        return $this->getPaidLabel();
    }

    public function getPaidLabel()
    {
        switch ($this->paid) {
            case self::PAID_TRUE:
                return __('general.Yes');
            case self::PAID_FALSE:
                return __('general.No');
        }
    }
}
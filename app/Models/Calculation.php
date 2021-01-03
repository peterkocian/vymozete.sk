<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasClaimTrait;
use App\Traits\HasCurrencyTrait;
use App\Traits\HasUserTrait;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasDateFormatTrait, HasCurrencyTrait, HasUserTrait, HasClaimTrait;
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
     * Vracia naformatovany datum 'date'
     *
     * @return false|string
     */
    public function getFormatedDateAttribute() {
        return date('d.m.Y', strtotime($this->date));
    }

    /**
     * Accessor => returns paid attribute as string, default its boolean
     *
     * @return string
     */
    public function getPaidLabelAttribute(): string
    {
        return $this->getPaidLabel();
    }

    /**
     * Private function that transform boolean value to string
     *
     * @return string
     */
    private function getPaidLabel(): string
    {
        switch ($this->paid) {
            case self::PAID_TRUE:
                return __('general.Yes');
            case self::PAID_FALSE:
                return __('general.No');
        }
    }
}

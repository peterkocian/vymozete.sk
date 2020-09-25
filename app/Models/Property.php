<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use DateFormatTrait;

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
     * Vsetky tieto atributy su automaticky priradene ku modelu, ked sa tahaju data z DB cez tento model.
     *
     * @var string[]
     */
//    protected $appends = ['amountWithCurrency'];

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

    /**
     * Get the claim_status record associated with the claim.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

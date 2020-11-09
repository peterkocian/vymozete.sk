<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
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
     * Get the currency record associated with the property.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the claim that owns the property.
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * Get the user that owns the property.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

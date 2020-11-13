<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use DateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'organization';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ico', 'vat', 'iban', 'phone', 'email', 'street', 'house_number', 'town', 'zip', 'country'
    ];

    /**
     * Function returns company full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    /**
     * Get all of the company's participants.
     */
    public function participants()
    {
        return $this->morphMany(Participant::class, 'entity');
    }

    /**
     * Function returns company's full address
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->street . ' ' . $this->house_number . ', ' . $this->zip . ' ' . $this->town;
    }
}

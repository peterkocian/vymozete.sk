<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRate extends Model
{
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'interest_rate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_type', 'date', 'coefficient'
    ];

    public static function getPersonInterestRates()
    {
        return self::query()->where('person_type', 0)->get();
    }

    public static function getOrganizationInterestRates()
    {
        return self::query()->where('person_type', 1)->get();
    }
}

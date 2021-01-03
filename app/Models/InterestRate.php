<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InterestRate extends Model
{
    const PERSON_TYPE_FO = 0;
    const PERSON_TYPE_PO = 1;
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

    /**
     * Returns array of interest rates for FO
     *
     * @return Collection
     */
    public static function getPersonInterestRates(): Collection
    {
        return self::query()->where('person_type', self::PERSON_TYPE_FO)->get();
    }

    /**
     * Returns array of interest rates for PO
     *
     * @return Collection
     */
    public static function getOrganizationInterestRates(): Collection
    {
        return self::query()->where('person_type', self::PERSON_TYPE_PO)->get();
    }
}

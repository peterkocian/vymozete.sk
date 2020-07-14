<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
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
        'name', 'ico', 'vat', 'phone', 'email', 'street', 'house_number', 'town', 'zip', 'country'
    ];

    /**
     * Get all of the organization's participants.
     */
    public function participants()
    {
        return $this->morphMany(Participant::class, 'entity');
    }
}

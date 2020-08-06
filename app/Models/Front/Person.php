<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'birthday', 'id_number', 'citizenship', 'phone', 'email', 'street', 'house_number', 'town', 'zip', 'country'
    ];

    /**
     * Function returns user's full name
     *
     * @return string
     */
    public function getFullNameAttribute() {
        return ucfirst($this->name) . ' ' . ucfirst($this->surname);
    }

    /**
     * Get all of the person's participants.
     */
    public function participants()
    {
        return $this->morphMany(Participant::class, 'entity');
    }
}

<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use DateFormatTrait;
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
        'name', 'surname', 'birthday', 'id_number', 'citizenship', 'iban', 'phone', 'email', 'street', 'house_number', 'town', 'zip', 'country'
    ];

    /**
     * Function returns user's full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->name) . ' ' . ucfirst($this->surname);
    }

    /**
     * Function returns formatted birthday
     *
     * @param $value
     * @return string
     */
    public function getBirthdayAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    /**
     * Get all of the person's participants.
     */
    public function participants()
    {
        return $this->morphMany(Participant::class, 'entity');
    }
}

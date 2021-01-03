<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasDateFormatTrait;
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
     * Set the user's name.
     * Pred ulozenim do DB sa kazde meno naformatuje na prve velke a ostatne male pismena
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    /**
     * Set the user's surname.
     * Pred ulozenim do DB sa kazde priezvisko naformatuje na prve velke a ostatne male pismena
     *
     * @param  string  $value
     * @return void
     */
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = ucfirst($value);
    }

    /**
     * Format the user's phone.
     * Pred ulozenim do DB sa kazde phone naformatuje => vymazu sa medzery
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = strtr($value,[' '=>'']);
    }

    /**
     * Function returns person's full name
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
        return $this->morphOne(Participant::class, 'entity');
    }

    /**
     * Function returns person's full address
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->street . ' ' . $this->house_number . ', ' . $this->zip . ' ' . $this->town;
    }
}

<?php

namespace App;

use App\Models\Front\Claim;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * Model User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = '/users/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * Vzdy ked pristupime ku atributu created_at, tak sa automaticky naformatuje podla tohto formatu
     *
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute($value) {
        return date('d.m.Y H:i:s', strtotime($value));
    }

    /**
     * Vzdy ked pristupime ku atributu updated_at, tak sa automaticky naformatuje podla tohto formatu
     *
     * @param $value
     * @return false|string
     */
    public function getUpdatedAtAttribute($value) {
        return date('d.m.Y H:i:s', strtotime($value));
    }

    /**
     * Get the claims by user
     */
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}

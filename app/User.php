<?php

namespace App;

use App\Helpers\DateFormatTrait;
use App\Models\Claim;
use App\Models\Language;
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
    use Notifiable, HasPermissionsTrait, DateFormatTrait;

    const INDEX_VIEW_PAGINATION = true;
    const INDEX_VIEW_PER_PAGE_SELECT = false;
    const PUBLIC_USER_DEFAULT_ROLE = 'public-user';

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'password', 'language_id', 'banned'
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
     * Function returns user's full name
     *
     * @return string
     */
    public function getFullNameAttribute() {
        return ucfirst($this->name) . ' ' . ucfirst($this->surname);
    }

    /**
     * Get the user's claims.
     */
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    /**
     * Get the user's language.
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

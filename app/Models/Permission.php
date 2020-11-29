<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    use DateFormatTrait;

    const INDEX_VIEW_PAGINATION = false;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'permission';

    /**
     * Pri update opravneni pouzivatela v pivot tabulkach (M:N) updatne timestamp updated_at aj v modeli users
     *
     * @var string[]
     */
    protected $touches = ['users'];

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Vzdy pred ulozenim atributu 'name' do DB sa zavola tato funkcia.
     * 'name' vyplni podla udajov z formularu a atribut 'slug' vygeneruje z 'name'
     *
     * @param $value
     */
    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Relacia na vsetky role jedneho objektu z modelu permission
     * Jedna permission moze byt priradena X rolam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_has_permission');
    }

    /**
     * Relacia na vsetkych userov jedneho objektu z modelu permission
     * Jedna permission moze byt priradena X uzivatelom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'user_has_permission');
    }
}

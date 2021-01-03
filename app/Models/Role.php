<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasPermissionsTrait, HasDateFormatTrait;

    const INDEX_VIEW_PAGINATION = false;
    const INDEX_VIEW_PER_PAGE_SELECT = false;

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'role';

    /**
     * Pri update roli pouzivatela v pivot tabulke (M:N) updatne timestamp updated_at aj v modeli users (parent)
     *
     * @var string[]
     */
    protected $touches = ['users'];

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = 'roles';

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
     * Relacia na vsetky permission jedneho objektu z modelu role
     * Jedna rola moze obsahovat X permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_has_permission');
    }

    /**
     * Relacia na vsetkych userov jedneho objektu z modelu role
     * Jedna rola moze byt priradena X uzivatelom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'user_has_role');
    }
}

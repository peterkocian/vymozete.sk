<?php

namespace App\Models\Admin;

use App\Permissions\HasPermissionsTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasPermissionsTrait;

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
    const ENTITY_ROUTE_PREFIX = '/admin/roles/';

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

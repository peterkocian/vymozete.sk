<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'permission';

    /**
     * parameter pre prefixovanie linkov buttonov v tabulke SimpleTable
     */
    const ENTITY_ROUTE_PREFIX = '/permissions/';

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

<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ClaimType extends Model
{
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'name', 'description'
    ];

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
}

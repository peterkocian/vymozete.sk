<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'task', 'sms_ntf', 'email_ntf', 'next_step', 'schedule_ntf', 'timeout'
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

    /**
     * Get the claims by claim_status
     */
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}

<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasAvailableTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{
    use HasDateFormatTrait, HasAvailableTranslationTrait;
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
        'name', 'next_step', 'schedule_ntf', 'timeout'
    ];

    public function translations()
    {
        return $this->hasMany(ClaimStatusTranslation::class, 'claim_status_id', 'id');
    }
}

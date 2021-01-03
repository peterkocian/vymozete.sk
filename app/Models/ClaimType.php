<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasAvailableTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class ClaimType extends Model
{
    use HasDateFormatTrait, HasAvailableTranslationTrait;
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
        'key'
    ];

    public function translations()
    {
        return $this->hasMany(ClaimTypeTranslation::class, 'claim_type_id', 'id');
    }
}

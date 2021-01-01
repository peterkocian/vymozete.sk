<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaimTypeTranslation extends Model
{
    use DateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim_type_translation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'language_id', 'claim_type_id'
    ];

//    /**
//     * Get the claim_type record associated with the claim_type_translation.
//     * @param $language_id
//     * @return BelongsTo
//     */
//    public function claimType($language_id)
//    {
//        return $this->belongsTo(ClaimType::class)->where('language_id', '=', $language_id);
//    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

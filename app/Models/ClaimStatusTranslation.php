<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaimStatusTranslation extends Model
{
    use HasDateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'claim_status_translation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'task', 'language_id', 'claim_status_id'
    ];

//    /**
//     * Get the claim_status record associated with the claim_status_translation.
//     * @param $language_id
//     * @return BelongsTo
//     */
//    public function claimStatus($language_id)
//    {
//        return $this->belongsTo(ClaimStatus::class)->where('language_id', '=', $language_id);
//    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

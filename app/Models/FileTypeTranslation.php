<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileTypeTranslation extends Model
{
    use DateFormatTrait;
    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'file_type_translation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'language_id', 'claim_type_id'
    ];

//    /**
//     * Get the file_type record associated with the file_type_translation.
//     * @param $language_id
//     * @return BelongsTo
//     */
//    public function fileType($language_id)
//    {
//        return $this->belongsTo(ClaimType::class)->where('language_id', '=', $language_id);
//    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileTypeTranslation extends Model
{
    use HasDateFormatTrait;
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

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

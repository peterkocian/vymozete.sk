<?php

namespace App\Models;

use App\Traits\HasDateFormatTrait;
use App\Traits\HasAvailableTranslationTrait;
use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    use HasDateFormatTrait, HasAvailableTranslationTrait;

    const DEFAULT_TYPE_ID_UPLOAD = 1;

    /**
     * Nazov tabulky v DB
     *
     * @var string
     */
    protected $table = 'file_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'name', 'description'];

    public function translations()
    {
        return $this->hasMany(FileTypeTranslation::class, 'file_type_id', 'id');
    }
}

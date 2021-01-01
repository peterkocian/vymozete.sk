<?php

namespace App\Models;

use App\Helpers\DateFormatTrait;
use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    use DateFormatTrait;

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

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function translations()
    {
        return $this->hasMany(FileTypeTranslation::class, 'file_type_id', 'id');
    }

    public function available_translation($language_id = null)
    {
        if ($language_id === null) {
            $language_id = Language::getDefaultLanguage();
        }

        return $this->translations()->where('language_id', $language_id);
    }
}
